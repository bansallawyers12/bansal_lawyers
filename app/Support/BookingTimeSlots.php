<?php

namespace App\Support;

/**
 * Selectable consultation slot labels (matches book appointment UI).
 * Generated from fixed start/end and interval — same list drives the frontend grid and APIs.
 */
class BookingTimeSlots
{
    private const START = '10:30 AM';

    private const END = '5:00 PM';

    private const INTERVAL_MINUTES = 30;

    /**
     * @return list<string>
     */
    public static function labels(): array
    {
        $slots = [];
        $current = strtotime(self::START);
        $end = strtotime(self::END);

        if ($current === false || $end === false) {
            return self::fallbackLabels();
        }

        while ($current <= $end) {
            $slots[] = date('g:i A', $current);
            $current = strtotime('+' . self::INTERVAL_MINUTES . ' minutes', $current);
        }

        return $slots;
    }

    /**
     * @return list<string>
     */
    private static function fallbackLabels(): array
    {
        return [
            '10:30 AM', '11:00 AM', '11:30 AM', '12:00 PM', '12:30 PM',
            '1:00 PM', '1:30 PM', '2:00 PM', '2:30 PM', '3:00 PM',
            '3:30 PM', '4:00 PM', '4:30 PM', '5:00 PM',
        ];
    }

    /**
     * Normalize a slot label to match {@see labels()} formatting (g:i A).
     */
    public static function normalizeLabel(string $label): string
    {
        $label = trim(preg_replace('/\s+/u', ' ', $label));
        if ($label === '') {
            return $label;
        }

        $ts = strtotime($label);
        if ($ts !== false) {
            return date('g:i A', $ts);
        }

        return $label;
    }
}
