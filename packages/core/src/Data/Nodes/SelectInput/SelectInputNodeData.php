<?php

namespace Pfy\Core\Data\Nodes\SelectInput;

use Pfy\Core\Contracts\DataPiper;
use Pfy\Core\Contracts\Executable;
use Pfy\Core\Data\Nodes\NodeData;

use function Laravel\Prompts\select;

/**
 * @property SelectInputNodeContentData $content
 */
class SelectInputNodeData extends NodeData implements Executable
{
    public function execute(DataPiper $dataPiper): void
    {
        $value = select(
            $this->content->label,
            $this->content->options,
            $this->content->default,
            $this->content->scroll,
            $this->content->validate,
            $this->content->hint,
            $this->content->required,
        );

        $dataPiper->set($this->content->key, $value);
    }
}
