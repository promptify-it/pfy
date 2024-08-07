<?php

namespace Pfy\Core\Data;

use Pfy\Core\Data\Nodes\RootNodeData;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Optional;

class CommandData extends Data
{
    public CommandOptionsData|Optional $options;

    public function __construct(
        public string $id,
        public string $signature,
        public string $description,
        public RootNodeData $root,
    ) {
        $this->options = new CommandOptionsData();
    }
}
