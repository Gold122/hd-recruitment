<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Task\Enums\TaskStatusEnum;
use Modules\Task\Models\Task;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<Task>
 */
class TaskFactory extends Factory
{
    protected $model = Task::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => "Task: ". fake()->colorName(),
            'description' => fake()->text(),
            'status' => fake()->randomElement(TaskStatusEnum::toArray()),
        ];
    }
}
