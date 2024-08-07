<?php

namespace Pfy\Core\Data\Nodes\Assign;

use Spatie\LaravelData\Data;

class AssignNodeContentData extends Data
{
    public function __construct(
        public string $key,
        public mixed $value,
    ) {
        //
    }
}
