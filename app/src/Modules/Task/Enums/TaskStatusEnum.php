<?php

namespace Modules\Task\Enums;

use Modules\Shared\Interfaces\EnumInterface;
use Modules\Shared\Traits\EnumTrait;

enum TaskStatusEnum: string implements EnumInterface
{
    use EnumTrait;

    case TODO = 'todo';
    case IN_PROGRESS = 'in_progress';
    case DONE = 'done';

}
