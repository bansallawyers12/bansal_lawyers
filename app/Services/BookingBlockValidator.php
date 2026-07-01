<?php

namespace App\Services;

use App\Models\BookServiceDisableSlot;
use App\Models\BookServiceSlotPerPerson;
use Carbon\Carbon;

class BookingBlockValidator
{
    private const MIN_PARTIAL_MINUTES = 30;

    /**
     * @param  array<int, string>  $dates
     * @param  array<int, mixed>  $fullDays
     * @param  array<int, string|null>  $startTimes
     * @param  array<int, string|null>  $endTimes
     * @return array{valid: bool, errors: array<string, list<string>>, blocks: list<array<string, mixed>>}
     */
    public function validate(
        array $dates,
        array $fullDays,
        array $startTimes,
        array $endTimes,
        int $slotPerPersonId = 1
    ): array {
        $errors = [];
        $normalizedBlocks = [];
        $service = BookServiceSlotPerPerson::find($slotPerPersonId);

        if (! $service) {
            return [
                'valid' => false,
                'errors' => ['blocks' => ['Booking service configuration was not found. Please contact support.']],
                'blocks' => [],
            ];
        }

        $serviceStart = $this->normalizeTime($service->start_time ?? '09:00');
        $serviceEnd = $this->normalizeTime($service->end_time ?? '17:00');
        $weekendDays = $this->parseWeekendDays($service->weekend ?? '');

        if (empty($dates) || ! collect($dates)->filter(fn ($d) => trim((string) $d) !== '')->count()) {
            return [
                'valid' => false,
                'errors' => ['blocks' => ['Please add at least one booking block with a date.']],
                'blocks' => [],
            ];
        }

        foreach ($dates as $index => $dateVal) {
            $rowLabel = 'Block '.($index + 1);
            $dateVal = trim((string) $dateVal);
            $fullDay = (int) ($fullDays[$index] ?? 0) === 1;
            $start = trim((string) ($startTimes[$index] ?? ''));
            $end = trim((string) ($endTimes[$index] ?? ''));

            if ($dateVal === '') {
                $errors["date.{$index}"][] = "{$rowLabel}: Date is required.";
                continue;
            }

            $parsedDate = $this->parseBlockDate($dateVal);
            if (! $parsedDate) {
                $errors["date.{$index}"][] = "{$rowLabel}: Invalid date. Use DD/MM/YYYY format.";
                continue;
            }

            if ($parsedDate->lt(Carbon::today())) {
                $errors["date.{$index}"][] = "{$rowLabel}: Date cannot be in the past.";
            }

            if ($this->isWeekend($parsedDate, $weekendDays)) {
                $errors["date.{$index}"][] = "{$rowLabel}: Selected date is a non-working day and is already unavailable for bookings.";
            }

            if ($fullDay) {
                $start = '';
                $end = '';
            } else {
                if ($start === '' || $end === '') {
                    $errors["start_time.{$index}"][] = "{$rowLabel}: Start time and end time are required when Full Day is No.";
                } else {
                    $startMinutes = $this->timeToMinutes($start);
                    $endMinutes = $this->timeToMinutes($end);

                    if ($startMinutes === null) {
                        $errors["start_time.{$index}"][] = "{$rowLabel}: Invalid start time.";
                    }
                    if ($endMinutes === null) {
                        $errors["end_time.{$index}"][] = "{$rowLabel}: Invalid end time.";
                    }

                    if ($startMinutes !== null && $endMinutes !== null) {
                        if ($startMinutes >= $endMinutes) {
                            $errors["end_time.{$index}"][] = "{$rowLabel}: End time must be after start time.";
                        } elseif (($endMinutes - $startMinutes) < self::MIN_PARTIAL_MINUTES) {
                            $errors["end_time.{$index}"][] = "{$rowLabel}: Time range must be at least ".self::MIN_PARTIAL_MINUTES.' minutes.';
                        }

                        $serviceStartMinutes = $this->timeToMinutes($serviceStart);
                        $serviceEndMinutes = $this->timeToMinutes($serviceEnd);

                        if ($serviceStartMinutes !== null && $serviceEndMinutes !== null) {
                            if ($startMinutes < $serviceStartMinutes || $endMinutes > $serviceEndMinutes) {
                                $errors["start_time.{$index}"][] = "{$rowLabel}: Time must be within booking hours ({$serviceStart} – {$serviceEnd}).";
                            }
                        }
                    }
                }
            }

            $normalizedBlocks[$index] = [
                'index' => $index,
                'row_label' => $rowLabel,
                'date_iso' => $parsedDate->format('Y-m-d'),
                'date_display' => $parsedDate->format('d/m/Y'),
                'full_day' => $fullDay,
                'start' => $start !== '' ? $this->normalizeTime($start) : '',
                'end' => $end !== '' ? $this->normalizeTime($end) : '',
            ];
        }

        if ($errors !== []) {
            return ['valid' => false, 'errors' => $errors, 'blocks' => []];
        }

        $duplicateErrors = $this->validateDuplicatesWithinSubmission($normalizedBlocks);
        if ($duplicateErrors !== []) {
            $errors['blocks'] = $duplicateErrors;
        }

        $existingErrors = $this->validateAgainstExistingBlocks($normalizedBlocks, $slotPerPersonId);
        if ($existingErrors !== []) {
            $errors['blocks'] = array_merge($errors['blocks'] ?? [], $existingErrors);
        }

        if ($errors !== []) {
            return ['valid' => false, 'errors' => $errors, 'blocks' => []];
        }

        return [
            'valid' => true,
            'errors' => [],
            'blocks' => array_values($normalizedBlocks),
        ];
    }

    public function parseBlockDate(string $dateVal): ?Carbon
    {
        $dateVal = trim($dateVal);
        if ($dateVal === '') {
            return null;
        }

        if (preg_match('#^\d{1,2}/\d{1,2}/\d{4}$#', $dateVal)) {
            try {
                return Carbon::createFromFormat('d/m/Y', $dateVal)->startOfDay();
            } catch (\Exception $e) {
                return null;
            }
        }

        if (preg_match('#^\d{4}-\d{2}-\d{2}$#', $dateVal)) {
            try {
                return Carbon::createFromFormat('Y-m-d', $dateVal)->startOfDay();
            } catch (\Exception $e) {
                return null;
            }
        }

        return null;
    }

    /**
     * @param  list<array<string, mixed>>  $blocks
     * @return list<string>
     */
    private function validateDuplicatesWithinSubmission(array $blocks): array
    {
        $errors = [];
        $count = count($blocks);

        for ($i = 0; $i < $count; $i++) {
            for ($j = $i + 1; $j < $count; $j++) {
                if ($blocks[$i]['date_iso'] !== $blocks[$j]['date_iso']) {
                    continue;
                }

                if ($this->timesOverlap($blocks[$i], $blocks[$j])) {
                    $errors[] = "{$blocks[$i]['row_label']} and {$blocks[$j]['row_label']} overlap on {$blocks[$i]['date_display']}.";
                }
            }
        }

        return $errors;
    }

    /**
     * @param  list<array<string, mixed>>  $blocks
     * @return list<string>
     */
    private function validateAgainstExistingBlocks(array $blocks, int $slotPerPersonId): array
    {
        $errors = [];
        $dateIsos = collect($blocks)->pluck('date_iso')->unique()->values();

        $existingSlots = BookServiceDisableSlot::query()
            ->where('book_service_slot_per_person_id', $slotPerPersonId)
            ->where(function ($query) use ($dateIsos) {
                foreach ($dateIsos as $iso) {
                    $query->orWhereDate('disabledates', $iso);
                }
            })
            ->get();

        $existingByDate = $existingSlots->groupBy(function ($slot) {
            $date = $slot->disabledates instanceof Carbon
                ? $slot->disabledates->format('Y-m-d')
                : Carbon::parse($slot->disabledates)->format('Y-m-d');

            return $date;
        });

        foreach ($blocks as $block) {
            $existingForDate = $existingByDate->get($block['date_iso'], collect());
            if ($existingForDate->isEmpty()) {
                continue;
            }

            foreach ($existingForDate as $existing) {
                $existingBlock = [
                    'full_day' => (int) $existing->block_all === 1,
                    'start' => '',
                    'end' => '',
                ];

                if (! $existingBlock['full_day'] && ! empty($existing->slots) && str_contains($existing->slots, '-')) {
                    [$existingStart, $existingEnd] = array_map('trim', explode('-', $existing->slots, 2));
                    $existingBlock['start'] = $this->normalizeTime($existingStart);
                    $existingBlock['end'] = $this->normalizeTime($existingEnd);
                }

                if ($this->timesOverlap($block, $existingBlock)) {
                    $errors[] = "{$block['row_label']}: A block already exists for {$block['date_display']}"
                        .($existingBlock['full_day'] ? ' (full day).' : " ({$existingBlock['start']} – {$existingBlock['end']}).");
                    break;
                }
            }
        }

        return $errors;
    }

    /**
     * @param  array<string, mixed>  $blockA
     * @param  array<string, mixed>  $blockB
     */
    private function timesOverlap(array $blockA, array $blockB): bool
    {
        if ($blockA['full_day'] || $blockB['full_day']) {
            return true;
        }

        $startA = $this->timeToMinutes($blockA['start'] ?? '');
        $endA = $this->timeToMinutes($blockA['end'] ?? '');
        $startB = $this->timeToMinutes($blockB['start'] ?? '');
        $endB = $this->timeToMinutes($blockB['end'] ?? '');

        if ($startA === null || $endA === null || $startB === null || $endB === null) {
            return false;
        }

        return $startA < $endB && $startB < $endA;
    }

    /**
     * @return list<int>
     */
    private function parseWeekendDays(string $weekend): array
    {
        if (trim($weekend) === '') {
            return [];
        }

        $map = [
            'Sun' => 0,
            'Mon' => 1,
            'Tue' => 2,
            'Wed' => 3,
            'Thu' => 4,
            'Fri' => 5,
            'Sat' => 6,
        ];

        $days = [];
        foreach (explode(',', $weekend) as $part) {
            $key = trim($part);
            if (isset($map[$key])) {
                $days[] = $map[$key];
            }
        }

        return $days;
    }

    /**
     * @param  list<int>  $weekendDays
     */
    private function isWeekend(Carbon $date, array $weekendDays): bool
    {
        return in_array((int) $date->dayOfWeek, $weekendDays, true);
    }

    private function normalizeTime(string $time): string
    {
        $minutes = $this->timeToMinutes($time);

        return $minutes === null ? $time : sprintf('%02d:%02d', intdiv($minutes, 60), $minutes % 60);
    }

    private function timeToMinutes(string $time): ?int
    {
        $time = trim($time);
        if ($time === '') {
            return null;
        }

        $timestamp = strtotime($time);

        if ($timestamp === false) {
            return null;
        }

        return ((int) date('G', $timestamp) * 60) + (int) date('i', $timestamp);
    }
}
