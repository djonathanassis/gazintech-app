<?php

declare(strict_types=1);

namespace App\Models;

use App\Models\Traits\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Level extends Model
{
    use SoftDeletes, Searchable;

    protected $fillable = [
        'level',
    ];
}
