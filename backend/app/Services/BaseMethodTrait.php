<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;


trait BaseMethodTrait
{
    final public function paginate(
        string $search = null,
        int $perPage = 15,
        string $sort = 'created_at',
        string $direction = 'desc'
    ): LengthAwarePaginator {
        return $this->model->search($search)
            ->orderBy($sort, $direction)
            ->paginate($perPage);
    }

    final public function create(array $data): Model
    {
        return $this->model->create($data);
    }

    final public function update(int $id, array $data): Model
    {
        $model = $this->model->findOrFail($id);

        $model?->update($data);

        return $model?->refresh();
    }

    final public function delete(int $id): void
    {
        $this->model->findOrFail($id)?->delete();
    }
}
