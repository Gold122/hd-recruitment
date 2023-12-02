<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\DummyApi\Repositories\Contracts\UserRepositoryContract;
use Modules\DummyApi\Repositories\UserRepository;
use Modules\DummyApi\Services\Interfaces\UserServiceInterface as UserDummyApiServiceInterface;
use Modules\DummyApi\Services\UserService as UserDummyApiService;
use Modules\Task\Repositories\Contracts\TaskRepositoryContract;
use Modules\Task\Repositories\TaskRepository;
use Modules\Task\Services\Interfaces\TaskServiceInterface;
use Modules\Task\Services\TaskService;
use Modules\User\Services\Interfaces\UserServiceInterface;
use Modules\User\Services\UserService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $binds = [
            UserRepositoryContract::class => UserRepository::class,
            UserDummyApiServiceInterface::class => UserDummyApiService::class,
            TaskRepositoryContract::class => TaskRepository::class,
            TaskServiceInterface::class => TaskService::class,
            UserServiceInterface::class => UserService::class,
        ];

        foreach ($binds as $abstract => $concrete) {
            $this->app->bind($abstract, $concrete);
        }
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
