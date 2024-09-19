<?php

declare(strict_types=1);

namespace App\DTOs;

use Illuminate\Support\Carbon;

class DeveloperDto extends AbstractDto
{
    public function __construct(
        public readonly string $name,
        public readonly string $sex,
        public readonly Carbon $dtBirth,
        public readonly ?string $hobby,
        public readonly int $levelId,
    ) {
    }

    public static function fromRequest(array $data): self
    {
        return new self(
            name: data_get($data, 'nome'),
            sex: data_get($data, 'sexo'),
            dtBirth: Carbon::parse(data_get($data, 'data_nascimento')),
            hobby: data_get($data, 'hobby'),
            levelId: data_get($data, 'nivel_id'),
        );
    }

    final public function toArray(): array
    {
        return [
            'name' => $this->name,
            'sex' => $this->sex,
            'dt_birth' => $this->dtBirth,
            'hobby' => $this->hobby,
            'level_id' => $this->levelId
        ];
    }
}
