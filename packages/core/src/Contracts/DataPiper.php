<?php

namespace Pfy\Core\Contracts;

interface DataPiper extends PersistentStorage
{
    /**
     * Merge data into the data piper.
     */
    public function merge(array $data): static;

    /**
     * Merge data from pipe file and remove it.
     */
    public function mergeFromPipe(): static;
}
