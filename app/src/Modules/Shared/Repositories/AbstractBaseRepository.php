<?php

namespace Modules\Shared\Repositories;

use Illuminate\Database\Eloquent\Model;
use Modules\Shared\Repositories\Contracts\BaseRepositoryContract;

class AbstractBaseRepository implements BaseRepositoryContract
{
    /**
     * @param Model $model
     */
    public function __construct(protected readonly Model $model) {}

    /**
     * @inheritDoc
     */
    public function all(): ?array
    {
        return $this->model->all()?->toArray();
    }

    /**
     * @inheritDoc
     */
    public function find(string $id): ?array
    {
        return $this->model->find($id)?->toArray();
    }

    /**
     * @inheritDoc
     */
    public function create(array $data): ?int
    {
        return $this->model->create($data)?->id;
    }
}
