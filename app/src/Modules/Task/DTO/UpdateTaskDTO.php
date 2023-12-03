<?php

namespace Modules\Task\DTO;

use Modules\Task\Enums\TaskStatusEnum;
use Spatie\LaravelData\Attributes\Validation\Enum;
use Spatie\LaravelData\Data;

class UpdateTaskDTO extends Data
{
    /**
     * UpdateTaskDTO constructor.
     *
     * @param int $id
     * @param string $name
     * @param string $description
     * @param TaskStatusEnum $status
     * @param int $user_id
     */
    public function __construct(
        public int $id,

        public string $name,

        public string $description,

        #[Enum(TaskStatusEnum::class)]
        public TaskStatusEnum $status,

        public int $user_id,
    ) {}
}
