<?php

namespace Pfy\Core\PersistentStorage;

use Illuminate\Support\Arr;
use Pfy\Core\Contracts\PersistentStorage;

class JsonPersistentStorage implements PersistentStorage
{
    protected $data = [];

    protected $loaded = false;

    protected function load(): array
    {
        $data = [];

        if (file_exists($this->path())) {
            $data = json_decode(file_get_contents($this->path()), true);
        }

        $this->loaded = true;

        return $data;
    }

    protected function save(): void
    {
        if (! file_exists(dirname($this->path()))) {
            mkdir(dirname($this->path()), 0777, true);
        }

        file_put_contents($this->path(), json_encode($this->data, JSON_PRETTY_PRINT));
    }

    /**
     * Get the value from the storage.
     */
    public function get(string $key, $default = null): mixed
    {
        if (! $this->loaded) {
            $this->data = $this->load();
        }

        return Arr::get($this->data, $key, $default);
    }

    /**
     * Set the value to the storage.
     */
    public function set(string $key, $value): void
    {
        if (! $this->loaded) {
            $this->data = $this->load();
        }

        Arr::set($this->data, $key, $value);

        $this->save();
    }

    /**
     * Check if the key exists in the storage.
     */
    public function has(string $key): bool
    {
        if (! $this->loaded) {
            $this->data = $this->load();
        }

        return Arr::has($this->data, $key);
    }

    /**
     * Remove the key from the storage.
     */
    public function remove(string $key): void
    {
        if (! $this->loaded) {
            $this->data = $this->load();
        }

        Arr::forget($this->data, $key);

        $this->save();
    }

    /**
     * Clear the storage.
     */
    public function clear(): void
    {
        foreach ($this->data as $key => $value) {
            Arr::forget($this->data, $key);
        }

        $this->data = [];

        $this->save();
    }

    /**
     * Get all the values from the storage.
     */
    public function all(): array
    {
        if (! $this->loaded) {
            $this->data = $this->load();
        }

        return $this->data;
    }

    /**
     * Get the path to the storage.
     */
    public function path(): string
    {
        return getenv('HOME').'/.pfy/storage.json';
    }
}
