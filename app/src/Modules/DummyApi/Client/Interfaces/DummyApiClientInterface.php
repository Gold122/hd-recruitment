<?php

namespace Modules\DummyApi\Client\Interfaces;

use Modules\DummyApi\Exceptions\DummyApiException;

interface DummyApiClientInterface
{
    /**
     * Get users.
     *
     * @param int $limit
     *
     * @return array|null
     * @throws DummyApiException
     */
    public function getUsers(int $limit = 10): ?array;

    /**
     * Get user.
     *
     * @param string $id
     *
     * @return array|null
     * @throws DummyApiException
     */
    public function getUser(string $id): ?array;
}
