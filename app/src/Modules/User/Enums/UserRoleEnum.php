<?php

namespace Modules\User\Enums;

use Modules\Shared\Interfaces\EnumInterface;
use Modules\Shared\Traits\EnumTrait;

enum UserRoleEnum: string implements EnumInterface
{
    use EnumTrait;

    case USER = 'user';
    case ADMIN = 'admin';
}
