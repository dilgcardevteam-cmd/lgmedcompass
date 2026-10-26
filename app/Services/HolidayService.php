<?php

namespace App\Services;

use Carbon\Carbon;
use Illuminate\Support\Facades\Http;

class HolidayService
{
    protected string $apiKey;

    protected string $baseUrl = 'https://calendarific.com/api/v2';

    public function __construct()
    {
        $this->apiKey = config('services.calendarific.key');
    }

    /**
     * Fetch holidays for a given year and country (default Philippines)
     */
    public function getHolidays(int $year, string $country = 'PH'): array
    {
        $response = Http::get($this->baseUrl.'/holidays', [
            'api_key' => $this->apiKey,
            'country' => $country,
            'year' => $year,
        ]);

        if ($response->failed()) {
            throw new \Exception('Failed to fetch holidays: '.$response->body());
        }

        $data = $response->json();

        return $data['response']['holidays'] ?? [];
    }

    /**
     * Transform API holiday into our event structure
     */
    public function transformToEvent(array $holiday): array
    {
        $date = Carbon::parse($holiday['date']['iso']);

        return [
            'title' => $holiday['name'],
            'type' => 'holiday',
            'visibility_type' => 'global',   // or 'public' – adjust to your enum
            'start_date' => $date->copy()->setTime(0, 0, 0)->toDateTimeString(),
            'end_date' => $date->copy()->setTime(23, 59, 59)->toDateTimeString(),
            'notes' => $holiday['description'] ?? null,
            'all_day' => true,
            // If your table has 'color', you can set it here, but frontend already uses type-based colors
        ];
    }
}
