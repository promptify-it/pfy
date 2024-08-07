<?php

namespace Pfy\Core\Contracts;

interface Executable
{
    /**
     * Execute the command.
     */
    public function execute(DataPiper $data): void;
}
