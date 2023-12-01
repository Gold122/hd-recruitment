<?php

namespace App\Enum;

trait EnumTrait
{
    /**
     * Return to array.
     *
     * @return array
     */
    public static function toArray(): array
    {
        return array_map(
            fn (self $enum) => $enum->value,
            static::cases()
        );
    }
}
