<?php

namespace Modules\User\Repositories;

use Modules\Shared\Repositories\AbstractBaseRepository;
use Modules\User\Models\User;
use Modules\User\Repositories\Contracts\UserRepositoryContract;

class UserRepository extends AbstractBaseRepository implements UserRepositoryContract
{
    /**
     * UserRepository constructor.
     *
     * @param User $model
     */
    public function __construct(User $model)
    {
        parent::__construct($model);
    }

    /**
     * @inheritDoc
     */
    public function findByEmail(string $email): ?User
    {
        return $this->model->where('email', $email)->first();
    }
}
