<?php

namespace Modules\DummyApi\Repositories\Contracts;

use Modules\DummyApi\Entity\UserEntity;
use Modules\DummyApi\Exceptions\DummyApiException;

interface UserRepositoryContract
{
    /**
     * Get all.
     *
     * @return array|null
     */
    public function all(): ?array;

    /**
     * Get a user from dummyapi.
     *
     * @param string $id
     *
     * @return UserEntity
     * @throws DummyApiException
     */
    public function find(string $id): UserEntity;
}
