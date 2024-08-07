<?php

namespace Pfy\Core\Data\Nodes\TextInput;

use Spatie\LaravelData\Data;

class TextInputNodeContentData extends Data
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
