<?php

namespace Modules\Shared\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Modules\Shared\Repositories\Contracts\CollectionRepositoryContract;

class AbstractBaseRepository implements CollectionRepositoryContract
{
    /**
     * AbstractBaseRepository constructor.
     *
     * @param Model $model
     */
    public function __construct(protected readonly Model $model) {}

    /**
     * @inheritDoc
     */
    public function all(): Collection
    {
        return $this->model->all();
    }

    /**
     * @inheritDoc
     */
    public function find(string $id): ?Model
    {
        return $this->model->find($id);
    }

    /**
     * @inheritDoc
     */
    public function create(array $data): ?int
    {
        return $this->model->create($data)?->id;
    }

    /**
     * @inheritDoc
     */
    public function update(int $id, array $data): bool
    {
        return $this->model->find($id)->update($data);
    }

    /**
     * @inheritDoc
     */
    public function delete(int $id): bool
    {
        return $this->model->find($id)->delete();
    }
}
