<?php

namespace Modules\Task\Services\Interfaces;

use App\Http\Resources\TaskCollection;
use App\Http\Resources\TaskResource;
use Illuminate\Http\JsonResponse;
use Modules\Task\DTO\CreateTaskDTO;
use Modules\Task\DTO\UpdateTaskDTO;
use Modules\User\Models\User;

interface TaskServiceInterface
{
    /**
     * Get all tasks for user with pagination.
     *
     * @param User $user
     *
     * @return TaskCollection
     */
    public function getAllWithPagination(User $user): TaskCollection;

    /**
     * Get task by id.
     *
     * @param int $id
     *
     * @return TaskResource|JsonResponse
     */
    public function show(int $id): TaskResource|JsonResponse;

    /**
     * Create task.
     *
     * @param CreateTaskDTO $data
     *
     * @return JsonResponse
     */
    public function create(CreateTaskDTO $data): JsonResponse;

    /**
     * Update task by id.
     *
     * @param UpdateTaskDTO $data
     *
     * @return JsonResponse
     */
    public function update(UpdateTaskDTO $data): JsonResponse;

    /**
     * Delete task by id.
     *
     * @param int $id
     *
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse;
}
