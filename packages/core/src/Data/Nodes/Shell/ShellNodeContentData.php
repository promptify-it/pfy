<?php

namespace Pfy\Core\Data\Nodes\Shell;

use Pfy\Core\Castables\ArrayToString;
use Spatie\LaravelData\Attributes\WithCast;
use Spatie\LaravelData\Data;

class ShellNodeContentData extends Data
{
    public function __construct(
        #[WithCast(ArrayToString::class)]
        public string $script,
    ) {
        //
    }
}
