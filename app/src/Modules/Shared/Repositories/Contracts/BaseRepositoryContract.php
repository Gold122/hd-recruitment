<?php

namespace Modules\Shared\Repositories\Contracts;

interface BaseRepositoryContract
{
    /**
     * @return array|null
     */
    public function all(): ?array;

    /**
     * @param string $id
     *
     * @return array|null
     */
    public function find(string $id): ?array;

    /**
     * @param array $data
     *
     * @return int|null
     */
    public function create(array $data): ?int;
}
