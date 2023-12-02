<?php

namespace Modules\Task\DTO;

use Modules\Task\Enums\TaskStatusEnum;
use Spatie\LaravelData\Attributes\Validation\Enum;
use Spatie\LaravelData\Data;

class CreateTaskDTO extends Data
{
    public function __construct(
        public string $name,

        public string $description,

        #[Enum(TaskStatusEnum::class)]
        public TaskStatusEnum $status,

        public int $user_id,
    ) {}
}
