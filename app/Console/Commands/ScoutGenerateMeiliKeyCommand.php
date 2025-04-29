<?php

namespace App\Console\Commands;

use DateTimeInterface;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Meilisearch\Client;
use Meilisearch\Endpoints\Keys;
use Meilisearch\Exceptions\ApiException;

use function Laravel\Prompts\text;

class ScoutGenerateMeiliKeyCommand extends Command
{
    protected $signature = 'scout:generate-meili-key';

    protected $description = 'Generates a Meilisearch API key';

    public function handle(): int
    {
        $masterToken = text('Enter your Meilisearch master key');
        $client = $this->getMeilisearchClient($masterToken);

        if (! $client->isHealthy()) {
            $this->error('Meilisearch is not running properly');

            return static::FAILURE;
        }

        if (! $this->isUsingValidApiKey($client)) {
            $this->error('The provided master key is invalid');

            return static::FAILURE;
        }

        try {
            $key = $this->createNewApiKey($client);

            $this->info("API key created: {$key->getKey()}");
        } catch (ApiException $e) {
            $this->error('An error occurred while creating a new API key');
            Log::error($e);

            return static::FAILURE;
        }

        return static::SUCCESS;
    }

    private function getMeilisearchClient(string $masterToken): Client
    {
        return new Client(config('scout.meilisearch.host'), $masterToken);
    }

    private function isUsingValidApiKey(Client $client): bool
    {
        try {
            $client->stats();

            return true;
        } catch (ApiException) {
            return false;
        }
    }

    private function createNewApiKey(Client $client): Keys
    {
        return $client->createKey($this->getKeyOptions());
    }

    private function getRequiredActions(): array
    {
        return [
            'search',
            'documents.add',
            'documents.get',
            'documents.delete',
            'indexes.create',
            'indexes.get',
            'indexes.update',
            'indexes.delete',
            'settings.update',
            'settings.get',
        ];
    }

    private function getRequiredIndexes(): array
    {
        return [
            'requests',
        ];
    }

    private function getPrefixedRequiredIndexes(): array
    {
        return array_map(fn (string $index) => config('scout.prefix').$index, $this->getRequiredIndexes());
    }

    private function getExpirationDate(): ?DateTimeInterface
    {
        return null;
    }

    private function getKeyOptions(): array
    {
        return [
            'name' => 'Webhook Tester',
            'actions' => $this->getRequiredActions(),
            'indexes' => $this->getPrefixedRequiredIndexes(),
            'expiresAt' => $this->getExpirationDate(),
        ];
    }
}
