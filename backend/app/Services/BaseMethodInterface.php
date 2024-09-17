<?php

declare(strict_types=1);

namespace App\Services;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

interface BaseMethodInterface
{
    public function paginate(): LengthAwarePaginator;
    public function create(array $data): Model;
    public function update(int $id, array $data): Model;
    public function delete(int $id): void;
}
