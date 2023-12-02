<?php

namespace Modules\DummyApi\Exceptions;

use Modules\Shared\Exceptions\CustomException;

class DummyApiException extends CustomException
{
    /**
     * Authorization failed.
     */
    public static function authorizationFailed(?string $message): self
    {
        return new self('Authorization failed. '.$message, 403);
    }
}
