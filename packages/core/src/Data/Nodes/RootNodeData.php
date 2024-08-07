<?php

namespace Pfy\Core\Data\Nodes;

use Pfy\Core\Castables\Node;
use Pfy\Core\Concerns\Nodes\ResolvesNodesRules;
use Spatie\LaravelData\Attributes\WithCast;
use Spatie\LaravelData\Data;

class RootNodeData extends Data
{
    use ResolvesNodesRules;

    public function __construct(
        #[WithCast(Node::class)]
        public array $nodes,
    ) {
        //
    }
}
