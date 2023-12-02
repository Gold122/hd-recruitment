<?php

namespace Modules\User\DTO;

use Spatie\LaravelData\Data;

class ImportUserDTO extends Data
{
    public function __construct(
        public string $id,
        public string $password
    ) {}
}
