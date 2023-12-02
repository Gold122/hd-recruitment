<?php

namespace Modules\User\Exceptions;

use Modules\Shared\Exceptions\CustomException;

class UserException extends CustomException
{
    /**
     * User already exists.
     *
     * @return self
     */
    public static function userAlreadyExists(): self
    {
        return new self('User already exists.', 409);
    }
}
