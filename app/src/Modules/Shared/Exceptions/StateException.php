<?php

namespace Modules\Shared\Exceptions;

class StateException extends CustomException
{
    /**
     * Cannot change state.
     *
     * @param string $fillable
     * @param string $oldValue
     * @param string $newValue
     *
     * @return self
     */
    public static function cannotChangeState(string $fillable, string $oldValue, string $newValue): self
    {
        return new self(
            message: "Cannot change state of {$fillable} from {$oldValue} to {$newValue}",
            code: 400
        );
    }
}
