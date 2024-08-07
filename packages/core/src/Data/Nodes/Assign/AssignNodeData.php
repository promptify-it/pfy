<?php

namespace Pfy\Core\Data\Nodes\Assign;

use Pfy\Core\Contracts\DataPiper;
use Pfy\Core\Contracts\Executable;
use Pfy\Core\Data\Nodes\NodeData;

/**
 * @property AssignNodeContentData $content
 */
class AssignNodeData extends NodeData implements Executable
{
    public function execute(DataPiper $dataPiper): void
    {
        $dataPiper->set($this->content->key, $this->content->value);

        if (is_string($this->content->value)) {
            $this->provideReplacersFor(
                $this->content->key,
                $this->content->value,
                $dataPiper,
            );
        }
    }
}
