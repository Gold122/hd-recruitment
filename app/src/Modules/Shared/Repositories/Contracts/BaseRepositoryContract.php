<?php

namespace Modules\Shared\Repositories\Contracts;

interface BaseRepositoryContract
{
    /**
     * Get all.
     *
     * @return array|null
     */
    public function all(): ?array;

    /**
     * Find by id.
     *
     * @param string $id
     *
     * @return array|null
     */
    public function find(string $id): ?array;

    /**
     * Create.
     *
     * @param array $data
     *
     * @return int|null
     */
    public function create(array $data): ?int;
}
