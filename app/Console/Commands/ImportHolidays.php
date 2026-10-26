<?php

namespace App\Console\Commands;

use App\Models\Event;
use App\Models\User;
use App\Services\HolidayService;
use Carbon\Carbon;
use Illuminate\Console\Command;

class ImportHolidays extends Command
{
    protected $signature = 'holidays:import {--year= : The year to import (defaults to current)} {--user= : User ID to assign holidays to}';

    protected $description = 'Import Philippine holidays from Calendarific API';

    public function handle(HolidayService $holidayService)
    {
        $year = $this->option('year') ?? Carbon::now()->year;
        $userId = $this->option('user');

        // Determine the user to assign holidays to
        if ($userId) {
            $user = User::find($userId);
            if (! $user) {
                $this->error("User with ID {$userId} not found.");

                return 1;
            }
        } else {
            try {
                $user = $this->getExistingUser();
            } catch (\Exception $e) {
                $this->error($e->getMessage());

                return 1;
            }
        }

        $this->info("Importing holidays for {$year} using user: {$user->name} (ID: {$user->id})...");

        try {
            $holidays = $holidayService->getHolidays($year);
            $bar = $this->output->createProgressBar(count($holidays));
            $bar->start();

            $imported = 0;
            $skipped = 0;

            foreach ($holidays as $holiday) {
                $data = $holidayService->transformToEvent($holiday);
                $date = Carbon::parse($data['start_date'])->toDateString();

                // Check if already exists (same title and date)
                $exists = Event::where('type', 'holiday')
                    ->where('title', $data['title'])
                    ->whereDate('start_date', $date)
                    ->exists();

                if (! $exists) {
                    // Add the required user_id
                    $data['user_id'] = $user->id;

                    // Create the event – only uses fillable fields from the model
                    Event::create($data);
                    $imported++;
                } else {
                    $skipped++;
                }

                $bar->advance();
            }

            $bar->finish();
            $this->newLine();
            $this->info("Done! Imported: {$imported}, Skipped (duplicates): {$skipped}");

        } catch (\Exception $e) {
            $this->error('Error: '.$e->getMessage());

            return 1;
        }

        return 0;
    }

    /**
     * Get an existing user to own the holidays.
     * Tries to find an admin user first, then falls back to the first user.
     *
     * @throws \Exception
     */
    private function getExistingUser()
    {
        // Try to find a user with admin role (adjust field name as needed)
        $admin = User::where('role', 'Admin')->first();
        if ($admin) {
            return $admin;
        }

        // Fallback: use the first user in the database
        $firstUser = User::orderBy('id')->first();
        if ($firstUser) {
            return $firstUser;
        }

        // If no user exists, throw an error
        throw new \Exception('No user found. Please create a user before importing holidays.');
    }
}
