<?php

namespace Pfy\Core\Concerns\Nodes;

trait ReplacesWithVariables
{
    public function replaceWithVariables(string $content, array $variables): string
    {
        foreach ($variables as $key => $value) {
            $content = str_replace(
                implode(' ', ['{{', $key, '}}']),
                $value,
                $content
            );
        }

        return $content;
    }
}
