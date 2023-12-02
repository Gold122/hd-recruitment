<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Http\Resources\TaskCollection;
use App\Http\Resources\TaskResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Modules\Task\DTO\CreateTaskDTO;
use Modules\Task\DTO\UpdateTaskDTO;
use Modules\Task\Services\Interfaces\TaskServiceInterface;

class TaskController extends Controller
{
    /**
     * @param TaskServiceInterface $taskService
     */
    public function __construct(private readonly TaskServiceInterface $taskService) {}

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): TaskCollection
    {
        return $this->taskService->getAllWithPagination($request->user());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateTaskRequest $request): JsonResponse
    {
        $data = ['user_id' => $request->user()->id, ...$request->validated()];

        return $this->taskService->create(
            CreateTaskDTO::from($data)
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): TaskResource|JsonResponse
    {
        return $this->taskService->show($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTaskRequest $request, string $id): JsonResponse
    {
        $data = [
            'user_id' => $request->user()->id,
            'id' => $id,
            ...$request->validated()
        ];

        return $this->taskService->update(UpdateTaskDTO::from($data));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): JsonResponse
    {
        return $this->taskService->destroy($id);
    }
}
