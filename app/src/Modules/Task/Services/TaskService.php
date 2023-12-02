<?php

namespace Modules\Task\Services;

use Modules\Task\Repositories\Contracts\TaskRepositoryContract;
use Modules\Task\Services\Interfaces\TaskServiceInterface;
use Modules\User\Models\User;

class TaskService implements TaskServiceInterface
{

    public function __construct(private readonly TaskRepositoryContract $taskRepository) {}

    public function getAll(User $user): ?array
    {
        return $this->taskRepository->getByUser($user->id);
    }
}
