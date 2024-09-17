<?php

declare(strict_types=1);

namespace App\Services\Level;

use App\Models\Level;
use App\Services\AbstractService;

class LevelService extends AbstractService
{
    public function __construct(Level $model)
    {
        parent::__construct($model);
    }
}
