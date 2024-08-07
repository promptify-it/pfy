<?php

namespace Pfy\Core\Contracts;

use Illuminate\Console\Command;
use Pfy\Core\Data\CommandData;

interface CommandFactory
{
    /**
     * Create a new command instance.
     */
    public function factory(CommandData $commandData): Command;
}
