<?php

namespace Database\Seeders;

use App\Console\Commands\ImportUsersCommand;
use Database\Factories\UserFactory;
use Illuminate\Database\Seeder;
use Modules\User\Enums\UserRoleEnum;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        UserFactory::new()->create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
            'role' => UserRoleEnum::ADMIN
        ]);

        UserFactory::new()->create([
            'name' => 'User',
            'email' => 'user@example.com',
            'password' => bcrypt('password'),
            'role' => UserRoleEnum::USER
        ]);

        $this->command->call(ImportUsersCommand::class);
    }
}
