<?php

namespace Pfy\Core\Data\Nodes\SelectInput;

use Pfy\Core\Castables\StringToArray;
use Spatie\LaravelData\Attributes\WithCast;
use Spatie\LaravelData\Data;

class SelectInputNodeContentData extends Data
{
    public function __construct(
        public string $key,
        public string $label,
        #[WithCast(StringToArray::class)]
        public array $options,
        public null|int|string $default = null,
        public int $scroll = 5,
        public mixed $validate = null,
        public string $hint = '',
        public bool|string $required = true
    ) {
        //
    }
}
