<?php

namespace Pfy\Core\Data\Nodes\PasswordInput;

use Spatie\LaravelData\Data;

class PasswordInputNodeContentData extends Data
{
    public function __construct(
        public string $key,
        public string $label,
        public string $placeholder = '',
        public string $default = '',
        public bool|string $required = false,
        public mixed $validate = null,
        public string $hint = ''
    ) {
        //
    }
}
