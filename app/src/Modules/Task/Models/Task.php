<?php

namespace Modules\Task\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Shared\Traits\HasState;
use Modules\Task\Enums\TaskStatusEnum;
use Modules\User\Models\User;

class Task extends Model
{
    use HasFactory;
    use HasState;

    protected $fillable = [
        'name',
        'description',
        'user_id',
        'status',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'status' => TaskStatusEnum::class,
    ];

    /**
     * Get the user that owns the task.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Set status flow.
     *
     * @return array[]
     */
    public function statusFlow(): array
    {
        return [
            TaskStatusEnum::TODO->value => [
                'to' => [TaskStatusEnum::IN_PROGRESS->value],
            ],
            TaskStatusEnum::IN_PROGRESS->value => [
                'to' => [TaskStatusEnum::TODO->value, TaskStatusEnum::DONE->value],
            ],
            TaskStatusEnum::DONE->value => [
                'to' => [TaskStatusEnum::IN_PROGRESS->value],
            ],
        ];
    }
}
