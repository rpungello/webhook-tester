<?php

namespace App\Console\Commands;

use App\Models\Request;
use Illuminate\Console\Command;

class ScoutPrepareCommand extends Command
{
    protected $signature = 'scout:prepare';

    protected $description = 'Prepares the search index for the application';

    public function handle(): int
    {
        $this->importModels();
        $this->syncIndexes();

        return static::SUCCESS;
    }

    private function importModels(): void
    {
        $this->call('scout:import', ['model' => Request::class]);
    }

    private function syncIndexes(): void
    {
        $this->call('scout:sync-index-settings');
    }
}
