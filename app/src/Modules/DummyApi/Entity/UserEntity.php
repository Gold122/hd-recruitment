<?php

namespace Modules\DummyApi\Entity;

use Spatie\LaravelData\Data;

class UserEntity extends Data
{
    public function __construct(
        public string $id,
        public string $name,
    ) {}

    public static function fromRepository(array $data): self
    {
        return new self(
            id: $data['id'],
            name: $data['firstName'] . ' ' . $data['lastName']
        );
    }
}
