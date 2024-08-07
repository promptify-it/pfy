<?php

namespace Pfy\Core\Data\Nodes;

use Pfy\Core\Castables\Node;
use Pfy\Core\Castables\NodeContent;
use Pfy\Core\Concerns\Nodes\ProvidesReplacers;
use Pfy\Core\Concerns\Nodes\ReplacesWithVariables;
use Pfy\Core\Concerns\Nodes\ResolvesNodesRules;
use Pfy\Core\Contracts\DataPiper;
use Pfy\Core\Contracts\Executable;
use Spatie\LaravelData\Attributes\Computed;
use Spatie\LaravelData\Attributes\WithCast;
use Spatie\LaravelData\Data;

/**
 * @property NodeData[] $nodes
 */
abstract class NodeData extends Data implements Executable
{
    use ProvidesReplacers;
    use ReplacesWithVariables;
    use ResolvesNodesRules;

    #[Computed]
    public string $type;

    #[WithCast(NodeContent::class)]
    public $content;

    #[WithCast(Node::class)]
    public array $nodes;

    public function __construct()
    {
        $this->type = $this->guessType();
        $this->nodes = [];
    }

    public function guessType(): string
    {
        return str(static::class)
            ->afterLast('\\')
            ->replace('NodeData', '')
            ->kebab()
            ->toString();
    }

    protected function executeNodes(DataPiper $data): void
    {
        collect($this->nodes)->each(function (Executable $node) use ($data) {
            $node->execute($data);
        });
    }
}
