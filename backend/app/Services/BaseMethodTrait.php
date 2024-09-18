<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

trait BaseMethodTrait
{
    public function paginate(
        Request $request,
        array $columns = [],
    ): LengthAwarePaginator {
        $search = $request->string('search');
        $page = $request->integer('page', 1);
        $perPage = $request->integer('per_page', 10);
        $sort = $request->string('sort', 'created_at');
        $direction = $request->string('order', 'asc');

        return $this->model->search($search, $columns)
            ->orderBy($sort, $direction)
            ->paginate($perPage, ['*'], 'page', $page);
    }

    public function create(array $data): Model
    {
        return $this->model->create($data)->refresh();
    }

    public function update(int $id, array $data): Model
    {
        $model = $this->model->find($id);

        if (null === $model) {
            abort(Response::HTTP_NOT_FOUND, 'Registro não encontrado.');
        }

        $model->update($data);

        return $model->refresh();
    }

    public function delete(int $id): void
    {
        $model = $this->model->find($id);

        if (null === $model) {
            abort(Response::HTTP_NOT_FOUND, 'Registro não encontrado.');
        }

        $model->delete();
    }
}
