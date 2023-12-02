<?php

namespace Modules\DummyApi\Repositories;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;
use Modules\DummyApi\Exceptions\DummyApiException;
use Modules\DummyApi\Repositories\Contracts\UserRepositoryContract;

class UserRepository implements UserRepositoryContract
{
    private PendingRequest $client;

    public function __construct()
    {
        $this->client = Http::withHeader('app-id', config('dummyapi.app_id'));
    }

    public function all(): ?array
    {
        $response = $this->client->get('https://dummyapi.io/data/v1/user?limit=10');
        if (!$response->successful()) {
            throw DummyApiException::authorizationFailed($response->body());
        }

        return $response->json('data');
    }

    public function find(string $id): ?array
    {
        $response = $this->client->get('https://dummyapi.io/data/v1/user/' . $id);
        if (!$response->successful()) {
            throw DummyApiException::authorizationFailed($response->body());
        }

        return $response->json();
    }

    public function create(array $data): ?int
    {
        throw new \Exception('Not implemented yet.');
    }
}
