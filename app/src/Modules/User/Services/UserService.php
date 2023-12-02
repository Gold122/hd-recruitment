<?php

namespace Modules\User\Services;

use Illuminate\Support\Facades\Hash;
use Modules\User\DTO\LoginDTO;
use Modules\User\Exceptions\LoginException;
use Modules\User\Models\User;
use Modules\User\Services\Interfaces\UserServiceInterface;

class UserService implements UserServiceInterface
{
    /**
     * Login a user.
     *
     * @param LoginDTO $dto
     *
     * @return string
     * @throws LoginException
     */
    public function login(LoginDTO $dto): string
    {
        $user = User::where('email', $dto->email)->first();

        if (!$user || !Hash::check($dto->password, $user->password)) {
            throw LoginException::invalidCredentials();
        }

        return $user->createToken('api')->plainTextToken;
    }
}
