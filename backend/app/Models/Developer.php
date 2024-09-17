<?php

declare(strict_types=1);

namespace App\Models;

use App\Models\Traits\Searchable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Developer extends Model
{
    use SoftDeletes, HasFactory, Searchable;

    protected $fillable = [
        'level_id',
        'name',
        'sex',
        'dt_birth',
        'hobby',
    ];

    protected $casts = [
        'dt_birth' => 'datetime',
    ];

    final public function level(): BelongsTo
    {
        return $this->belongsTo(Level::class);
    }
}
