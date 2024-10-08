<?php

declare(strict_types=1);

namespace App\Models;

use App\Models\Traits\Searchable;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

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

    protected $appends = ['age'];

    final public function level(): BelongsTo
    {
        return $this->belongsTo(Level::class);
    }

    final public function getAgeAttribute(): int
    {
        return Carbon::parse($this->dt_birth)->age;
    }
}
