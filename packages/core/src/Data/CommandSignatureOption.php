<?php

namespace Pfy\Core\Data;

use Spatie\LaravelData\Data;

class CommandSignatureOptionData extends Data
{
    public function __construct(
        public string $name,
        public string $description,
        public string $type,
        public bool $isRequired = false,
        public mixed $default = null,
    ) {}
}
