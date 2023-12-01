<?php

namespace App\Enum;

use App\Interface\EnumInterface;

enum TaskStatusEnum: string implements EnumInterface
{
    use EnumTrait;

    case TODO = "todo";
    case IN_PROGRESS = "in_progress";
    case DONE = "done";

}
