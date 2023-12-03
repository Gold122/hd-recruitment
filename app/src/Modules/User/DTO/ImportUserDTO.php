<?php

namespace Modules\User\DTO;

use Spatie\LaravelData\Data;

class ImportUserDTO extends Data
{
    /**
     * ImportUserDTO constructor.
     *
     * @param string $id
     * @param string $password
     */
    public function __construct(
        public string $id,
        public string $password
    ) {}
}
