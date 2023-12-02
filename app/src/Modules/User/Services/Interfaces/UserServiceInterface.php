<?php

namespace Modules\User\Services\Interfaces;

use Modules\User\DTO\LoginDTO;

interface UserServiceInterface
{
    public function login(LoginDTO $dto): string;
}
