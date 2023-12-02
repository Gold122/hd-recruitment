<?php

namespace Modules\Shared\Traits;

trait EnumTrait
{
    /**
     * Return to array.
     */
    public static function toArray(): array
    {
        return array_map(
            fn (self $enum) => $enum->value,
            static::cases()
        );
    }
}
