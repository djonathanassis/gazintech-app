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
            'name' => $this->name,
            'sex' => $this->sex,
            'dt_birth' => $this->dt_birth,
            'hobby' => $this->hobby,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'level_id' => $this->level_id,
            'level' => new LevelResource($this->whenLoaded('level')),
        ];
    }
}
