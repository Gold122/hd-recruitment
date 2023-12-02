<?php

namespace Modules\DummyApi\Repositories;

use Modules\DummyApi\Client\Interfaces\DummyApiClientInterface;
use Modules\DummyApi\Entity\UserEntity;
use Modules\DummyApi\Exceptions\DummyApiException;
use Modules\DummyApi\Repositories\Contracts\UserRepositoryContract;

readonly class UserRepository implements UserRepositoryContract
{
    /**
     * UserRepository constructor.
     *
     * @param DummyApiClientInterface $dummyApiClient
     */
    public function __construct(private DummyApiClientInterface $dummyApiClient) {}

    /**
     * Get all users from dummyapi.
     *
     * @return array|null
     * @throws DummyApiException
     */
    public function all(): ?array
    {
        return $this->dummyApiClient->getUsers();
    }

    /**
     * @inheritDoc
     */
    public function find(string $id): UserEntity
    {
        return UserEntity::fromRepository($this->dummyApiClient->getUser($id));
    }

    /**
     * Create a user.
     *
     * @param array $data
     *
     * @return int|null
     * @throws \Exception
     */
    public function create(array $data): ?int
    {
        throw new \Exception('Not implemented yet.');
    }
}
