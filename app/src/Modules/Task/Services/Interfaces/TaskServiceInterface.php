<?php

namespace Modules\Task\Services\Interfaces;

use Modules\User\Models\User;

interface TaskServiceInterface
{
    public function getAll(User $user): ?array;
}
