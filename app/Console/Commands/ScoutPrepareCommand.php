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
        $this->flushModels();
        $this->importModels();
        $this->syncIndexes();

        return static::SUCCESS;
    }

    private function flushModels(): void
    {
        foreach ($this->getModels() as $model) {
            $this->call('scout:flush', compact('model'));
        }
    }

    private function importModels(): void
    {
        foreach ($this->getModels() as $model) {
            $this->call('scout:import', compact('model'));
        }
    }

    private function syncIndexes(): void
    {
        $this->call('scout:sync-index-settings');
    }

    /**
     * @return class-string[]
     */
    private function getModels(): array
    {
        return [
            Request::class,
        ];
    }
}
