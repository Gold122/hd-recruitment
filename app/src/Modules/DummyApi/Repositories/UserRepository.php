<?php

namespace Modules\DummyApi\Repositories;

use Modules\DummyApi\Client\Interfaces\DummyApiClientInterface;
use Modules\DummyApi\Entity\UserEntity;
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
     * @inheritDoc
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
}
