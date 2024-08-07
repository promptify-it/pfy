<?php

namespace Pfy\Core\Contracts;

use Pfy\Core\Data\CommandSignatureOptionData;

interface Optionable
{
    /**
     * Get the options as an array.
     *
     * @return array<int, CommandSignatureOptionData>
     */
    public function asOptions(): array;
}
