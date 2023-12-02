<?php

namespace Modules\Shared\Repositories\Contracts;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface CollectionRepositoryContract
{
    /**
     * Get all.
     *
     * @return Collection
     */
    public function all(): Collection;

    /**
     * Find by id.
     *
     * @param string $id
     *
     * @return Model|null
     */
    public function find(string $id): ?Model;

    /**
     * Create.
     *
     * @param array $data
     *
     * @return int|null
     */
    public function create(array $data): ?int;

    /**
     * Update by id.
     *
     * @param int $id
     * @param array $data
     *
     * @return bool
     */
    public function update(int $id, array $data): bool;

    /**
     * Delete by id.
     *
     * @param int $id
     *
     * @return bool
     */
    public function delete(int $id): bool;
}
