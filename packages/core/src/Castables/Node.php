<?php

namespace Pfy\Core\Castables;

use Exception;
use Spatie\LaravelData\Casts\Cast;
use Spatie\LaravelData\Support\Creation\CreationContext;
use Spatie\LaravelData\Support\DataProperty;

class Node implements Cast
{
    public function cast(DataProperty $property, mixed $value, array $properties, CreationContext $context): mixed
    {
        if (! is_array($value)) {
            throw new Exception('The value must be an array');
        }

        return $this->castNodes($value);
    }

    private function guessNodeClass(string $name): string
    {
        $name = str($name)->studly()->toString();

        return 'PromptifyIt\\PromptifyIt\\Data\\Nodes\\'.$name.'\\'.$name.'NodeData';
    }

    private function castNode(array $node): mixed
    {
        $nodeClass = $this->guessNodeClass($node['type']);

        if (! class_exists($nodeClass)) {
            throw new Exception("Class {$nodeClass} does not exist");
        }

        unset($node['type']);

        return $nodeClass::from($node);
    }

    private function castNodes(array $nodes): array
    {
        return array_map(function (array $node) {
            return $this->castNode($node);
        }, $nodes);
    }
}
