<?php

namespace Modules\Task\Repositories\Contracts;

use Illuminate\Pagination\LengthAwarePaginator;
use Modules\Shared\Repositories\Contracts\CollectionRepositoryContract;

interface TaskRepositoryContract extends CollectionRepositoryContract
{
    /**
     * Get all tasks by user with pagination.
     *
     * @param int $userId
     *
     * @return LengthAwarePaginator
     */
    public function getByUserWithPagination(int $userId): LengthAwarePaginator;

    /**
     * Get all tasks with pagination.
     *
     * @return LengthAwarePaginator
     */
    public function getAllWithPagination(): LengthAwarePaginator;
}
