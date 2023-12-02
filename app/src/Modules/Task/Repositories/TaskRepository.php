<?php

namespace Modules\Task\Repositories;

use Illuminate\Pagination\LengthAwarePaginator;
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
    public function getByUserWithPagination(int $userId): LengthAwarePaginator
    {
        return $this->model->where('user_id', $userId)->paginate();
    }

    /**
     * @inheritDoc
     */
    public function getAllWithPagination(): LengthAwarePaginator
    {
        return $this->model->with('user')->paginate();
    }
}
