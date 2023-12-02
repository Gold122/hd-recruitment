<?php

namespace Modules\DummyApi\Services;

use Modules\DummyApi\Repositories\Contracts\UserRepositoryContract;
use Modules\DummyApi\Services\Interfaces\UserServiceInterface;

class UserService implements UserServiceInterface
{
    /**
     * UserService constructor.
     *
     * @param UserRepositoryContract $userRepository
     */
    public function __construct(private readonly UserRepositoryContract $userRepository) {}

    /**
     * @inheritDoc
     */
    public function getAll(): ?array
    {
        return $this->userRepository->all();
    }

    /**
     * @inheritDoc
     */
    public function getUser(string $id): ?array
    {
        return $this->userRepository->find($id);
    }
}
