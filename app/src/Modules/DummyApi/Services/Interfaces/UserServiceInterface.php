<?php

namespace Modules\DummyApi\Services\Interfaces;

use Modules\DummyApi\Entity\UserEntity;
use Modules\DummyApi\Exceptions\DummyApiException;

interface UserServiceInterface
{
    /**
     * Get all users.
     *
     * @return array|null
     */
    public function getAll(): ?array;

    /**
     * Get user by id.
     *
     * @param string $id
     *
     * @return UserEntity
     * @throws DummyApiException
     */
    public function getUser(string $id): UserEntity;
}
