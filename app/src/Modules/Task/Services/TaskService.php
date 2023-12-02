<?php

namespace Modules\Task\Services;

use App\Http\Resources\TaskCollection;
use App\Http\Resources\TaskResource;
use Illuminate\Http\JsonResponse;
use Modules\Task\DTO\CreateTaskDTO;
use Modules\Task\DTO\UpdateTaskDTO;
use Modules\Task\Repositories\Contracts\TaskRepositoryContract;
use Modules\Task\Services\Interfaces\TaskServiceInterface;
use Modules\User\Models\User;

readonly class TaskService implements TaskServiceInterface
{
    /**
     * @param TaskRepositoryContract $taskRepository
     */
    public function __construct(private TaskRepositoryContract $taskRepository) {}

    /**
     * @inheritDoc
     */
    public function getAllWithPagination(User $user): TaskCollection
    {
        if ($user->isAdmin()) {
            return new TaskCollection($this->taskRepository->getAllWithPagination());
        }
        return new TaskCollection($this->taskRepository->getByUserWithPagination($user->id));
    }

    /**
     * @inheritDoc
     */
    public function show(int $id): TaskResource|JsonResponse
    {
        $task = $this->taskRepository->find($id);
        if (!$task) {
            return response()->json(['message' => 'Task not found'], 404);
        }
        return new TaskResource($this->taskRepository->find($id));
    }

    /**
     * @inheritDoc
     */
    public function create(CreateTaskDTO $data): JsonResponse
    {
        $this->taskRepository->create($data->toArray());
        return response()->json(['message' => 'Successfully created task']);
    }

    /**
     * @inheritDoc
     */
    public function update(UpdateTaskDTO $data): JsonResponse
    {
        $this->taskRepository->update($data->id, $data->except('id')->toArray());
        return response()->json(['message' => 'Successfully updated task']);
    }

    /**
     * @inheritDoc
     */
    public function destroy(int $id): JsonResponse
    {
        $this->taskRepository->delete($id);
        return response()->json(['message' => 'Successfully deleted task']);
    }
}
