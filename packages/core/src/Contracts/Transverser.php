<?php

namespace Pfy\Core\Contracts;

interface Transverser
{
    /**
     * Transverse the command.
     */
    public function transverse(): void;
}
