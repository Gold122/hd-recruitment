<?php

namespace Database\Seeders;

use Database\Factories\TaskFactory;
use Illuminate\Database\Seeder;
use Modules\User\Models\User;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::all()->each(function (User $user) {
            TaskFactory::new()->count(3)->create([
                'user_id' => $user->id,
            ]);
        });
    }
}
