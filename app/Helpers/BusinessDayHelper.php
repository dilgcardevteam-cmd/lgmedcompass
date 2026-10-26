<?php

namespace App\Helpers;

use App\Models\Event;
use Carbon\Carbon;

class BusinessDayHelper
{
    /**
     * Check if a given date is a holiday
     */
    public static function isHoliday($date): bool
    {
        $carbonDate = is_string($date) ? Carbon::parse($date) : $date;

        // Check if there's a holiday event on this date
        return Event::where('type', 'holiday')
            ->whereDate('start_date', $carbonDate->toDateString())
            ->exists();
    }

    /**
     * Check if a given date is a weekend (Saturday or Sunday)
     */
    public static function isWeekend($date): bool
    {
        $carbonDate = is_string($date) ? Carbon::parse($date) : $date;

        return $carbonDate->isSaturday() || $carbonDate->isSunday();
    }

    /**
     * Check if a given date is a business day (not weekend and not holiday)
     */
    public static function isBusinessDay($date): bool
    {
        return ! self::isWeekend($date) && ! self::isHoliday($date);
    }

    /**
     * Get the next business day after a given date
     */
    public static function getNextBusinessDay($date): Carbon
    {
        $carbonDate = is_string($date) ? Carbon::parse($date) : $date;
        $nextDay = $carbonDate->copy()->addDay();

        // Keep adding days until we find a business day
        while (! self::isBusinessDay($nextDay)) {
            $nextDay->addDay();
        }

        return $nextDay;
    }

    /**
     * Adjust a date to the next business day if it falls on weekend or holiday
     */
    public static function adjustToBusinessDay($date): Carbon
    {
        $carbonDate = is_string($date) ? Carbon::parse($date) : $date;

        // If it's already a business day, return as is
        if (self::isBusinessDay($carbonDate)) {
            return $carbonDate;
        }

        // Otherwise, find the next business day
        return self::getNextBusinessDay($carbonDate);
    }
}
