<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
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
    public function index(Request $request)
    {
        return response()->json($this->taskService->getAll($request->user()));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
