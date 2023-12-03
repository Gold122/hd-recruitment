<?php

namespace Modules\DummyApi\Entity;

use Spatie\LaravelData\Data;

class UserEntity extends Data
{
    /**
     * UserEntity constructor.
     *
     * @param string $id
     * @param string $name
     * @param string|null $email
     */
    public function __construct(
        public string $id,
        public string $name,
        public ?string $email
    ) {}

    /**
     * Create a new UserEntity from repository data.
     *
     * @param array $data
     *
     * @return static
     */
    public static function fromRepository(array $data): self
    {
        return new self(
            id: $data['id'],
            name: $data['firstName'] . ' ' . $data['lastName'],
            email: $data['email'] ?? null,
        );
    }
}
