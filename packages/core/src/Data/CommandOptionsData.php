<?php

namespace Pfy\Core\Data;

use Spatie\LaravelData\Data;

class CommandOptionsData extends Data
{
    /**
     * Whether or not to load the .env file.
     */
    public bool $shouldLoadDotenv = true;

    /**
     * The working directory to run the command in.
     */
    public string $workingDirectory;

    public function __construct()
    {
        $this->workingDirectory = $_ENV['PWD'];
    }
}
