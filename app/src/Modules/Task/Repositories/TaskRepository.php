<?php

namespace Modules\Task\Repositories;

use Modules\Shared\Repositories\AbstractBaseRepository;
use Modules\Task\Repositories\Contracts\TaskRepositoryContract;
use Modules\Task\Models\Task;

class TaskRepository extends AbstractBaseRepository implements TaskRepositoryContract
{
    public function __construct(Task $model)
    {
        parent::__construct($model);
    }

    /**
     * @inheritDoc
     */
    public function getByUser(int $userId): ?array
    {
        return $this->model->where('user_id', $userId)->get()->toArray();
    }
}
