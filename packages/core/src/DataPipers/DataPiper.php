<?php

namespace Pfy\Core\DataPipers;

use Dotenv\Dotenv;
use Pfy\Core\Contracts\PersistentStorage;

/**
 * The data piper is responsible for storing the data that is being passed
 * between the nodes of the command.
 */
class DataPiper implements \Pfy\Core\Contracts\DataPiper
{
    /**
     * Each data piper has a unique id.
     * This id is used to store the data for the entire command lifecycle.
     */
    private $id;

    public function __construct(
        private string $commandId,
    ) {
        $this->id = \Illuminate\Support\Str::uuid();
    }

    /**
     * Compose the key for the data piper storage.
     */
    private function composeKey(string $key): string
    {
        return $this->persistenceStoragePath().'.'.$key;
    }

    /**
     * Get the instance of the persistent storage.
     */
    private function persistenceStorage(): PersistentStorage
    {
        return app(PersistentStorage::class);
    }

    /**
     * Get the path to the data piper storage.
     */
    private function persistenceStoragePath(): string
    {
        return 'commands.'.$this->commandId.'.data_piper';
    }

    /**
     * {@inheritDoc}
     */
    public function set(string $key, $value): void
    {
        $this->persistenceStorage()->set($this->composeKey($key), $value);
    }

    /**
     * {@inheritDoc}
     */
    public function path(): string
    {
        return dirname($this->persistenceStorage()->path()).'/.'.$this->id;
    }

    /**
     * {@inheritDoc}
     */
    public function merge(array $data): static
    {
        $this->persistenceStorage()->set(
            $this->persistenceStoragePath(),
            array_merge($this->all(), $data)
        );

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function mergeFromPipe(): static
    {
        $dotenv = Dotenv::parse(
            $this->qualifyEnvContent(file_get_contents($this->path()))
        );

        $this->merge($dotenv);

        unlink($this->path());

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function get(string $key, $default = null)
    {
        return $this->persistenceStorage()->get($this->composeKey($key), []);
    }

    /**
     * {@inheritDoc}
     */
    public function all(): array
    {
        return $this->persistenceStorage()->get($this->persistenceStoragePath(), []);
    }

    /**
     * {@inheritDoc}
     */
    public function clear(): void
    {
        $this->persistenceStorage()->remove('commands.'.$this->commandId);
    }

    /**
     * {@inheritDoc}
     */
    public function has(string $key): bool
    {
        return $this->persistenceStorage()->has($this->composeKey($key));
    }

    /**
     * {@inheritDoc}
     */
    public function remove(string $key): void
    {
        $this->persistenceStorage()->remove($this->composeKey($key));
    }

    /**
     * Some variables in the .env file may be string that contain white spaces.
     * We need to qualify the content of the .env file to avoid issues with the parser
     * wrapping the content in double quotes.
     */
    private function qualifyEnvContent(string $content): string
    {
        $lines = explode("\n", $content);

        $qualifiedContent = '';

        foreach ($lines as $line) {
            $line = trim($line);

            if (! empty($line)) {
                $splitted = explode('=', $line);

                if (count($splitted) === 2 && ! is_numeric($splitted[1]) && ! in_array($splitted[1], ['true', 'false'])) {
                    $qualifiedContent .= $splitted[0].'="'.$splitted[1].'"'."\n";
                } else {
                    $qualifiedContent .= $line."\n";
                }
            }
        }

        return $qualifiedContent;
    }
}
