<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Modules\DummyApi\Services\Interfaces\UserServiceInterface;
use Modules\User\Models\User;

class ImportUsersCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:import-users';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import users from DummyApi.';

    /**
     * Execute the console command.
     */
    public function handle(UserServiceInterface $userService)
    {
        $this->info('Importing users from DummyApi...');

        $users = $userService->getAll();
        $this->withProgressBar($users, function ($user) use ($userService){
            $userInfo = $userService->getUser($user['id']);
            User::create([
                'name' => $userInfo['firstName'].' '.$userInfo['lastName'],
                'email' => $userInfo['email'],
                'password' => bcrypt('password')
            ]);
        });

        $this->newLine();
        $this->info('Imported users from DummyApi: '.count($users));
    }
}
