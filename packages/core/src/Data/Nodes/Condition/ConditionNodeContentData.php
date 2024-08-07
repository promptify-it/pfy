<?php

namespace Pfy\Core\Data\Nodes\Condition;

use Spatie\LaravelData\Data;

class ConditionNodeContentData extends Data
{
    public function __construct(
        public string $left,
        public string $operator,
        public string $right,
    ) {
        //
    }
}
