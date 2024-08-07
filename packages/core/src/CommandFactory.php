<?php

namespace Pfy\Core;

use Illuminate\Console\Command;
use Pfy\Core\Contracts\CommandFactory as CommandFactoryContract;
use Pfy\Core\Data\CommandData;

class CommandFactory implements CommandFactoryContract
{
    public function factory(CommandData $commandData): Command
    {
        return new class($commandData) extends Command
        {
            protected $signature;

            protected $description;

            public function __construct(protected CommandData $commandData)
            {
                $this->signature = $commandData->signature;
                $this->description = $commandData->description;

                parent::__construct();
            }

            public function handle(): void
            {
                (new CommandDataHandler($this->commandData))->handle();
            }
        };
    }
}
