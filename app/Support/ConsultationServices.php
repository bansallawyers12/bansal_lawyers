<?php

namespace App\Support;

use App\Models\BookService;

final class ConsultationServices
{
    /** 30 minute paid consultation — $150 */
    public const PAID_30 = 1;

    /** 10 minute free consultation — first time only */
    public const FREE_10 = 2;

    /** 1 hour paid consultation — $220 */
    public const PAID_60 = 3;

    /** @return list<int> */
    public static function websiteServiceIds(): array
    {
        return [self::PAID_30, self::FREE_10, self::PAID_60];
    }

    public static function isValidWebsiteServiceId(int $serviceId): bool
    {
        return in_array($serviceId, self::websiteServiceIds(), true);
    }

    public static function isFreeTier(int $serviceId): bool
    {
        return $serviceId === self::FREE_10;
    }

    public static function allowsPromoCode(int $serviceId): bool
    {
        return $serviceId === self::PAID_30;
    }

    public static function parsePriceAud(?BookService $service): float
    {
        if (! $service) {
            return 0.0;
        }

        return (float) str_replace(['aud', 'AUD', '$', ' '], '', (string) $service->price);
    }

    /** @return list<array{id: int, title: string, duration: int, price_aud: float, price_label: string, is_free: bool}> */
    public static function activeForBookingUi(): array
    {
        return BookService::query()
            ->whereIn('id', self::websiteServiceIds())
            ->where('status', true)
            ->orderByRaw('FIELD(id, '.self::FREE_10.','.self::PAID_30.','.self::PAID_60.')')
            ->get()
            ->map(function (BookService $s) {
                $priceAud = self::parsePriceAud($s);
                $duration = (int) $s->duration;

                return [
                    'id' => (int) $s->id,
                    'title' => (string) $s->title,
                    'duration' => $duration,
                    'duration_label' => self::durationLabel($duration),
                    'price_aud' => $priceAud,
                    'price_label' => $priceAud <= 0 ? 'Free' : '$'.number_format($priceAud, 0).' AUD',
                    'is_free' => $priceAud <= 0,
                    'allows_promo' => self::allowsPromoCode((int) $s->id),
                ];
            })
            ->values()
            ->all();
    }

    public static function durationLabel(int $minutes): string
    {
        if ($minutes >= 60) {
            $hours = intdiv($minutes, 60);
            $remainder = $minutes % 60;

            return $remainder > 0 ? "{$hours} hr {$remainder} min" : ($hours === 1 ? '1 hour' : "{$hours} hours");
        }

        return "{$minutes} mins";
    }
}
