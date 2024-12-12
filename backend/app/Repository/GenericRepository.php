<?php

declare(strict_types=1);

namespace App\Repository;

use App\Repository\Interface\RepositoryInterface;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Database\Eloquent\Model;

readonly class GenericRepository implements RepositoryInterface
{
    public function __construct(
        private RepositoryInterface $repository
    ) {
    }

    public function managerEloquent(string $name = null): RepositoryInterface
    {
       return $this->repository->managerEloquent($name);
    }

    public function list(array $with = []): Paginator
    {
        return $this->repository->list($with);
    }

    public function findById(int $id): Model
    {
        return $this->repository->findById($id);
    }

    public function create(array $data): Model
    {
        return $this->repository->create($data);
    }

    public function update(int $id, array $data): Model
    {
        return $this->repository->update($id, $data);
    }

    public function delete(int $id): void
    {
        $this->repository->delete($id);
    }
}
