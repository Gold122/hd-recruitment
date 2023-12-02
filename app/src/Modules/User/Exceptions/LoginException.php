<?php

namespace Modules\User\Exceptions;

use Modules\Shared\Exceptions\CustomException;

class LoginException extends CustomException
{
    /**
     * Invalid credentials.
     *
     * @return self
     */
    public static function invalidCredentials(): self
    {
        return new self('Invalid credentials', 401);
    }
}
