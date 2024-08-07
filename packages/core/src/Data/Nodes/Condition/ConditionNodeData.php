<?php

namespace Pfy\Core\Data\Nodes\Condition;

use Pfy\Core\Contracts\DataPiper;
use Pfy\Core\Contracts\Executable;
use Pfy\Core\Data\Nodes\NodeData;

/**
 * @property ConditionNodeContentData $content
 */
class ConditionNodeData extends NodeData implements Executable
{
    public function execute(DataPiper $dataPiper): void
    {
        $left = $this->replaceWithVariables($this->content->left, $dataPiper->all());
        $operator = $this->content->operator;
        $right = $this->replaceWithVariables($this->content->right, $dataPiper->all());

        if ($operator === '==') {
            $result = $left == $right;
        } elseif ($operator === '===') {
            $result = $left === $right;
        } elseif ($operator === '!=') {
            $result = $left != $right;
        } elseif ($operator === '!==') {
            $result = $left !== $right;
        } elseif ($operator === '>') {
            $result = $left > $right;
        } elseif ($operator === '>=') {
            $result = $left >= $right;
        } elseif ($operator === '<') {
            $result = $left < $right;
        } elseif ($operator === '<=') {
            $result = $left <= $right;
        } else {
            throw new \Exception('Invalid operator');
        }

        if ($result) {
            $this->executeNodes($dataPiper);
        }
    }
}
