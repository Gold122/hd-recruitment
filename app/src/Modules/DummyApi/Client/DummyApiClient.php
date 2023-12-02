<?php

namespace Modules\DummyApi\Client;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;
use Modules\DummyApi\Client\Interfaces\DummyApiClientInterface;
use Modules\DummyApi\Exceptions\DummyApiException;

class DummyApiClient implements DummyApiClientInterface
{
    private PendingRequest $client;

    /**
     * DummyApiClient constructor.
     */
    public function __construct()
    {
        $this->client = Http::withHeader('app-id', config('dummyapi.app_id'));
    }

    /**
     * @inheritDoc
     */
    public function getUsers(int $limit = 10): ?array
    {
        return $this->get('https://dummyapi.io/data/v1/user', ['limit' => $limit], 'data');
    }

    /**
     * @inheritDoc
     */
    public function getUser(string $id): ?array
    {
        return $this->get('https://dummyapi.io/data/v1/user/' . $id);
    }

    /**
     * Get request.
     *
     * @param string $url
     * @param array|null $query
     * @param string|null $key
     *
     * @return array|null
     * @throws DummyApiException
     */
    private function get(string $url, array $query = null, ?string $key = null): ?array
    {
        $response = $this->client->get($url, $query);
        if (!$response->successful()) {
            match ($response->status()) {
                403 => throw DummyApiException::authorizationFailed($response->body()),
                default => throw DummyApiException::unknownError($response->body()),
            };
        }

        return $response->json($key);
    }
}
