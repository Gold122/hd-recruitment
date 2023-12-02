<?php

namespace Modules\DummyApi\Exceptions;

use Modules\Shared\Exceptions\CustomException;

class DummyApiException extends CustomException
{
    /**
     * Authorization failed.
     *
     * @param string|null $message
     *
     * @return DummyApiException
     */
    public static function authorizationFailed(?string $message): self
    {
        return new self('Authorization failed. ' . $message, 403);
    }

    /**
     * Unknown error.
     *
     * @param string $body
     *
     * @return self
     */
    public static function unknownError(string $body): self
    {
        return new self('Unknown error. ' . $body, 500);
    }
}
