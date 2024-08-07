<?php

namespace Pfy\Core\Concerns\Nodes;

use Spatie\LaravelData\Support\Validation\ValidationContext;

trait ResolvesNodesRules
{
    public static function rules(ValidationContext $context): array
    {
        return static::resolveNodesRules($context);
    }

    public static function resolveNodesRules(ValidationContext $context): array
    {
        $rules = [
            'nodes' => ['required', 'array'],
            'nodes.*.type' => ['required', 'string', 'in:'.implode(',', array_keys(resolve('promptify-it.nodes')))],
        ];

        $rules = array_merge($rules, self::recursiveNodeRules($context->payload['nodes'], 'nodes'));

        return $rules;
    }

    private static function recursiveNodeRules(array $nodes, string $path): array
    {
        $rules = [];

        foreach ($nodes as $index => $node) {
            $rules["{$path}.{$index}.nodes"] = ['required', 'array'];
            $rules["{$path}.{$index}.nodes.*.type"] = ['required', 'string', 'in:'.implode(',', array_keys(resolve('promptify-it.nodes')))];

            $contentRules = resolve('promptify-it.nodes')[str($node['type'])->camel()->toString()]['nodeContentData']::getValidationRules($node['content']);

            foreach ($contentRules as $key => $value) {
                $rules["{$path}.{$index}.content.{$key}"] = $value;
            }

            if (isset($node['nodes'])) {
                $rules = array_merge($rules, self::recursiveNodeRules($node['nodes'], "{$path}.{$index}.nodes"));
            }
        }

        return $rules;
    }
}
