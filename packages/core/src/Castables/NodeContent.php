<?php

namespace Pfy\Core\Castables;

use Exception;
use Spatie\LaravelData\Casts\Cast;
use Spatie\LaravelData\Support\Creation\CreationContext;
use Spatie\LaravelData\Support\DataProperty;

class NodeContent implements Cast
{
    public function cast(DataProperty $property, mixed $value, array $properties, CreationContext $context): mixed
    {
        $nodeClass = $this->guessNodeContentClass($context->dataClass);

        if (! class_exists($nodeClass)) {
            throw new Exception("Class {$nodeClass} does not exist");
        }

        return $nodeClass::from($value);
    }

    private function guessNodeContentClass(string $nodeClass): string
    {
        return str($nodeClass)->replace('NodeData', 'NodeContentData')->toString();
    }
}
