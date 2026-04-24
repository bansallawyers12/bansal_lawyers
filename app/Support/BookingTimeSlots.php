<?php

namespace App\Support;

/**
 * Selectable consultation slot labels (matches book appointment UI).
 * Not generated from start_time/end_time — same fixed list as the frontend grid.
 */
class BookingTimeSlots
{
    /**
     * @return list<string>
     */
    public static function labels(): array
    {
        return [
            '9:30 AM',
            '11:00 AM',
            '11:30 AM',
            '2:00 PM',
            '2:30 PM',
            '3:00 PM',
            '3:30 PM',
            '4:00 PM',
            '4:30 PM',
            '5:00 PM',
        ];
    }
}
