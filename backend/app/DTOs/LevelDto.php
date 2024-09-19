<?php

declare(strict_types=1);

namespace App\DTOs;

class LevelDto extends AbstractDto
{
    public function __construct(
        public readonly string $level,
    ) {
    }

    public static function fromRequest(array $data): self
    {
        return new self(
            level: data_get($data, 'nivel'),
        );
    }
}
