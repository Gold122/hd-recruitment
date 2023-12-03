<?php

namespace Tests\Feature\Http\Controllers\Api;

use Database\Factories\TaskFactory;
use Database\Factories\UserFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use Laravel\Sanctum\Sanctum;
use Modules\Task\Enums\TaskStatusEnum;
use Tests\TestCase;

class TaskControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_get_all_tasks()
    {
        $user = UserFactory::new()->create();
        $tasks = TaskFactory::new()->count(5)->create([
            'user_id' => $user->id,
        ]);

        Sanctum::actingAs($user);

        $response = $this->getJson(route('tasks.index'));
        $response->assertStatus(Response::HTTP_OK)
            ->assertJson([
                'data' => $tasks
                    ->only(['id', 'title', 'description', 'status'])
                    ->toArray(),
            ]);
    }

    /** @test */
    public function it_can_create_a_task()
    {
        $user = UserFactory::new()->create();

        Sanctum::actingAs($user);

        $data = [
            'name' => 'Task name',
            'description' => 'Task description',
            'status' => TaskStatusEnum::TODO,
        ];

        $response = $this->postJson(route('tasks.store'), $data);
        $response->assertStatus(Response::HTTP_CREATED)
            ->assertJsonStructure([
                'message'
            ]);

        $this->assertDatabaseHas('tasks', $data);
    }

    /** @test */
    public function it_can_show_a_task()
    {
        $user = UserFactory::new()->create();
        $task = TaskFactory::new()->create([
            'user_id' => $user->id,
            'status' => TaskStatusEnum::TODO,
        ]);

        Sanctum::actingAs($user);

        $taskData = [
            'id' => $task->id,
            'name' => $task->name,
            'description' => $task->description,
            'status' => $task->status->value,
        ];

        $response = $this->getJson(route('tasks.show', $task->id));
        $response->assertStatus(Response::HTTP_OK)
            ->assertJson([
                'data' => $taskData
            ]);
    }

    /** @test */
    public function it_can_update_a_task()
    {
        $user = UserFactory::new()->create();
        $task = TaskFactory::new()->create([
            'user_id' => $user->id,
            'status' => TaskStatusEnum::TODO,
        ]);

        Sanctum::actingAs($user);

        $data = [
            'name' => 'Task name',
            'description' => 'Task description',
            'status' => TaskStatusEnum::IN_PROGRESS,
        ];

        $response = $this->putJson(route('tasks.update', $task->id), $data);
        $response->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure([
                'message'
            ]);

        $this->assertDatabaseHas('tasks', [
            'id' => $task->id,
            'status' => TaskStatusEnum::IN_PROGRESS->value,
        ]);
    }

    /** @test */
    public function it_cant_change_status_update_a_task()
    {
        $user = UserFactory::new()->create();
        $task = TaskFactory::new()->create([
            'user_id' => $user->id,
            'status' => TaskStatusEnum::TODO,
        ]);

        Sanctum::actingAs($user);

        $data = [
            'name' => 'Task name',
            'description' => 'Task description',
            'status' => TaskStatusEnum::DONE,
        ];

        $response = $this->putJson(route('tasks.update', $task->id), $data);
        $response->assertStatus(Response::HTTP_BAD_REQUEST)
            ->assertJsonStructure([
                'message'
            ]);

        $this->assertDatabaseHas('tasks', [
            'id' => $task->id,
            'status' => TaskStatusEnum::TODO->value,
        ]);
    }

    /** @test */
    public function it_can_delete_a_task()
    {
        $user = UserFactory::new()->create();
        $task = TaskFactory::new()->create([
            'user_id' => $user->id,
            'status' => TaskStatusEnum::TODO,
        ]);

        Sanctum::actingAs($user);

        $response = $this->deleteJson(route('tasks.destroy', $task->id));
        $response->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure([
                'message'
            ]);

        $this->assertDatabaseMissing('tasks', [
            'id' => $task->id,
        ]);
    }
}
