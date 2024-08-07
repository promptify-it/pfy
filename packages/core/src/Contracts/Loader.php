<?php

namespace Pfy\Core\Contracts;

use Illuminate\Support\Collection;

interface Loader
{
    /**
     * Load the commands.
     */
    public function loadCommands(): Collection;
}
