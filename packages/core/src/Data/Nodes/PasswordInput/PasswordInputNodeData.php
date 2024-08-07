<?php

namespace Pfy\Core\Data\Nodes\PasswordInput;

use Pfy\Core\Contracts\DataPiper;
use Pfy\Core\Contracts\Executable;
use Pfy\Core\Data\Nodes\NodeData;

use function Laravel\Prompts\password;

/**
 * @property PasswordInputNodeContentData $content
 */
class PasswordInputNodeData extends NodeData implements Executable
{
    public function execute(DataPiper $dataPiper): void
    {
        $value = password(
            $this->content->label,
            $this->content->placeholder,
            $this->content->required,
            $this->content->validate,
            $this->content->hint
        );

        $dataPiper->set($this->content->key, $value);
    }
}
