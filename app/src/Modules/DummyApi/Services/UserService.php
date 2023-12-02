<?php

namespace Modules\DummyApi\Services;

use Modules\DummyApi\Entity\UserEntity;
use Modules\DummyApi\Repositories\Contracts\UserRepositoryContract;
use Modules\DummyApi\Services\Interfaces\UserServiceInterface;

readonly class UserService implements UserServiceInterface
{
    /**
     * UserService constructor.
     *
     * @param UserRepositoryContract $userRepository
     */
    public function __construct(private UserRepositoryContract $userRepository) {}

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
    public function getUser(string $id): UserEntity
    {
        return $this->userRepository->find($id);
    }
}
