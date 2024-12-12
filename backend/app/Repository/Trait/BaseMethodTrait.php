<?php

namespace App\Repository\Trait;

use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Database\Eloquent\Model;
use Symfony\Component\HttpFoundation\Response;

trait BaseMethodTrait
{
    public function list(array $with = []): Paginator
    {
        return $this->model->newQuery()
            ->with($with)
            ->simplePaginate();
    }

    public function findById(int $id): ?Model
    {
        return $this->model->newQuery()
            ->find($id);
    }

    public function create(array $data): Model
    {
        return $this->model->newQuery()
            ->create($data)
            ->refresh();
    }

    public function update(int $id, array $data): Model
    {
        $model = $this->findById($id);

        if (null === $model) {
            abort(Response::HTTP_NOT_FOUND, 'Registro não encontrado.');
        }

        $model->update($data);

        return $model->refresh();
    }

    public function delete(int $id): void
    {
        $model = $this->findById($id);

        if (null === $model) {
            abort(Response::HTTP_NOT_FOUND, 'Registro não encontrado.');
        }

        $model->delete();
    }
}
