<?php

declare(strict_types=1);

namespace App\Services\Developer;

use App\Models\Developer;
use App\Repository\Interface\RepositoryInterface;

readonly class DeveloperService
{
    public function __construct(
        private RepositoryInterface $repository
    ) {
        $this->repository->managerEloquent(Developer::class);
    }

    public function list()
    {
        return $this->repository->list();
    }

    public function findById(int $id): object
    {
        return $this->repository->findById($id);
    }

    public function create(array $data): Developer
    {
        return $this->repository->create($data);
    }

    public function update(int $id, array $data): Developer
    {
        return $this->repository->update($id, $data);
    }

    public function delete(int $id): void
    {
        $this->repository->delete($id);
    }
}
