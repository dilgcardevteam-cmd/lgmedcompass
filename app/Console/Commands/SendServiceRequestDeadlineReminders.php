<?php

namespace App\Console\Commands;

use App\Models\ServiceRequest;
use App\Models\User;
use App\Notifications\ServiceRequestDeadlineReminder;
use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Builder;

class SendServiceRequestDeadlineReminders extends Command
{
    protected $signature = 'requests:send-deadline-reminders';

    protected $description = 'Notify staff about open service requests nearing or past their needed-by date';

    public function handle(): int
    {
        $today = today();
        $reminderCount = 0;
        $serviceRequests = ServiceRequest::query()
            ->whereIn('status', ServiceRequest::OPEN_STATUSES)
            ->whereDate('date_needed', '<=', $today->copy()->addDays(3))
            ->with(['assignedTo', 'requester'])
            ->get();

        foreach ($serviceRequests as $serviceRequest) {
            $reminderType = $serviceRequest->date_needed->lt($today)
                ? 'overdue'
                : ($serviceRequest->date_needed->isToday() ? 'today' : 'soon');

            foreach ($this->recipientsFor($serviceRequest) as $recipient) {
                if ($serviceRequest->requester_user_id === $recipient->id) {
                    continue;
                }

                $alreadyNotified = $recipient->notifications()
                    ->where('type', ServiceRequestDeadlineReminder::class)
                    ->where('data->service_request_id', $serviceRequest->id)
                    ->whereDate('created_at', $today)
                    ->exists();

                if ($alreadyNotified) {
                    continue;
                }

                $recipient->notify(new ServiceRequestDeadlineReminder($serviceRequest, $reminderType));
                $reminderCount++;
            }
        }

        $this->info("Sent {$reminderCount} service request deadline reminder(s).");

        return self::SUCCESS;
    }

    /**
     * @return \Illuminate\Support\Collection<int, User>
     */
    private function recipientsFor(ServiceRequest $serviceRequest): \Illuminate\Support\Collection
    {
        if ($serviceRequest->assignedTo !== null) {
            return collect([$serviceRequest->assignedTo]);
        }

        return User::query()
            ->where('role', '<>', 'Pending')
            ->whereNotNull('email_verified_at')
            ->when(
                $serviceRequest->target_section_id !== null,
                fn (Builder $query) => $query->where('section_id', $serviceRequest->target_section_id),
                fn (Builder $query) => $query->where('role', 'Admin')
            )
            ->get();
    }
}
