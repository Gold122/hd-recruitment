<?php

namespace Modules\User\DTO;

use Spatie\LaravelData\Attributes\Validation\Email;
use Spatie\LaravelData\Attributes\Validation\Max;
use Spatie\LaravelData\Attributes\Validation\Min;
use Spatie\LaravelData\Attributes\Validation\Required;
use Spatie\LaravelData\Attributes\Validation\StringType;
use Spatie\LaravelData\Data;

class LoginDTO extends Data
{
    public function __construct(
        #[Required]
        #[Email]
        public string $email,

        #[Required]
        #[StringType]
        #[Min(4)]
        #[Max(32)]
        public string $password,
    ) {}
}
