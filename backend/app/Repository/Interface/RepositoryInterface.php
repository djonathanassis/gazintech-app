<?php

declare(strict_types=1);

namespace App\Repository\Interface;

use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Database\Eloquent\Model;

interface RepositoryInterface
{
    public function managerEloquent(string $name = null): self;
    public function list(array $with = []): Paginator;
    public function findById(int $id): ?Model;
    public function create(array $data): Model;
    public function update(int $id, array $data): Model;
    public function delete(int $id): void;
}
