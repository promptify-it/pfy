<?php

namespace Pfy\Core;

use Pfy\Core\Contracts\DataPiper;
use Pfy\Core\Contracts\Executable;
use Pfy\Core\Data\CommandData;

class Transverser
{
    public function __construct(
        private CommandData $commandData,
    ) {
        //
    }

    public function transverse(DataPiper $dataPiper): void
    {
        collect($this->commandData->root->nodes)->each(function (Executable $node) use (&$dataPiper) {
            $node->execute($dataPiper);
        });
    }
}
