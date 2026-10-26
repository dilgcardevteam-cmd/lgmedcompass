<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Artisan;

class ImportHolidaysAfterRegistration
{
    /**
     * Handle the event.
     *
     * @return void
     */
    public function handle(Registered $event)
    {
        $user = $event->user;

        // Run the import command synchronously, passing the new user's ID
        Artisan::call('holidays:import', [
            '--user' => $user->id,
            // Optionally you can pass a specific year, e.g. '--year' => date('Y')
        ]);
    }
}
