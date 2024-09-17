<?php

declare(strict_types=1);

namespace App\Services\Developer;

use App\Models\Developer;
use App\Services\AbstractService;

class DeveloperService extends AbstractService
{
    public function __construct(Developer $model)
    {
        parent::__construct($model);
    }
}
