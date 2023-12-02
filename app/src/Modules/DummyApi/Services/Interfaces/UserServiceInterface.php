<?php

namespace Modules\DummyApi\Services\Interfaces;

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
     * @return array|null
     */
    public function getUser(string $id): ?array;
}
