<?php

declare(strict_types=1);

namespace App\Http\Resources;

use App\Models\Developer;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Developer */
class DeveloperResource extends JsonResource
{
   final public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'nome' => $this->name,
            'sexo' => $this->sex,
            'data_nascimento' => $this->dt_birth,
            'idade' => $this->age,
            'hobby' => $this->hobby,
            'level' => $this->level()->first(['id', 'level']),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
