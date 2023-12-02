<?php

namespace Modules\User\Repositories\Contracts;

use Modules\Shared\Repositories\Contracts\CollectionRepositoryContract;
use Modules\User\Models\User;

interface UserRepositoryContract extends CollectionRepositoryContract
{
    /**
     * Find a user by email.
     *
     * @param string $email
     *
     * @return User|null
     */
    public function findByEmail(string $email): ?User;
}
