<?php

namespace App\Console\Commands;

use App\Models\Document;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class DeleteOldDocuments extends Command
{
    protected $signature = 'documents:delete-old';

    protected $description = 'Permanently delete archived documents older than 3 years';

    public function handle(): int
    {
        $deletedCount = 0;

        Document::onlyTrashed()
            ->where('deleted_at', '<=', now()->subYears(3))
            ->get()
            ->each(function (Document $document) use (&$deletedCount): void {
                $files = json_decode($document->file_path ?? '[]', true);

                if (is_array($files)) {
                    foreach ($files as $file) {
                        Storage::disk('public')->delete($file);
                    }
                }

                $document->forceDelete();
                $deletedCount++;
            });

        $this->info("{$deletedCount} old archived documents deleted.");

        return self::SUCCESS;
    }
}
