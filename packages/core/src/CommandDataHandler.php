<?php

namespace Pfy\Core;

use Pfy\Core\Contracts\DataPiper;
use Pfy\Core\Data\CommandData;

class CommandDataHandler
{
    private DataPiper $dataPiper;

    public function __construct(
        public CommandData $commandData,
    ) {
        $this->dataPiper = app(DataPiper::class, [
            'commandId' => $this->commandData->id,
        ]);
    }

    /**
     * Determine if the dotenv file should be loaded.
     */
    private function shouldLoadDotenv(): bool
    {
        return $this->commandData->options->shouldLoadDotenv;
    }

    private function loadDotenv(): void
    {
        $dotenv = \Dotenv\Dotenv::createImmutable($this->commandData->options->workingDirectory);
        $dotenv->safeLoad();

        $this->dataPiper->merge($_ENV);
    }

    private function beforeHandle(): void
    {
        if ($this->shouldLoadDotenv()) {
            $this->loadDotenv();
        }
    }

    private function afterHandle(): void
    {
        $this->dataPiper->clear();
    }

    /**
     * Handle the command data.
     */
    public function handle(): void
    {
        $this->beforeHandle();

        (new Transverser($this->commandData))->transverse($this->dataPiper);

        $this->afterHandle();
    }
}
