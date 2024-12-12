<?php

declare(strict_types=1);

namespace App\Services\Level;

use App\Models\Level;
use App\Repository\Interface\RepositoryInterface;

readonly class LevelService
{
    public function __construct(
        private RepositoryInterface $repository
    ) {
       $this->repository->managerEloquent(Level::class);
    }

    public function list()
    {
        return $this->repository->list();
    }

    public function findById(int $id): object
    {
        return $this->repository->findById($id);
    }

    public function create(array $data): Level
    {
        return $this->repository->create($data);
    }

    public function update(int $id, array $data): Level
    {
        return $this->repository->update($id, $data);
    }

    public function delete(int $id): void
    {
        $this->repository->delete($id);
    }
}
