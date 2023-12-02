<?php

namespace Modules\Task\Repositories\Contracts;

use Modules\Shared\Repositories\Contracts\BaseRepositoryContract;

interface TaskRepositoryContract extends BaseRepositoryContract
{
    /**
     * Get all tasks by user.
     *
     * @param int $userId
     *
     * @return array|null
     */
    public function getByUser(int $userId): ?array;
}
