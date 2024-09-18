<?php

declare(strict_types=1);

namespace App\Models;

use App\Models\Traits\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Level extends Model
{
    use SoftDeletes, Searchable;

    protected $fillable = [
        'level',
    ];

    final public function developers(): HasMany
    {
        return $this->hasMany(Developer::class,'level_id','id');
    }
}
