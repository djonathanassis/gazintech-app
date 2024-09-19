<?php

declare(strict_types=1);

namespace App\Models;

use App\Models\Traits\Searchable;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Level extends Model
{
    use HasFactory, SoftDeletes, Searchable;

    protected $fillable = [
        'level',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }


    final public function developers(): HasMany
    {
        return $this->hasMany(Developer::class,'level_id','id');
    }
}
