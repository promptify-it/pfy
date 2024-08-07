<?php

namespace Pfy\Core\Contracts;

interface PersistentStorage
{
    /**
     * Get the value from the storage.
     */
    public function get(string $key, $default = null);

    /**
     * Set the value to the storage.
     */
    public function set(string $key, $value): void;

    /**
     * Check if the key exists in the storage.
     */
    public function has(string $key): bool;

    /**
     * Remove the key from the storage.
     */
    public function remove(string $key): void;

    /**
     * Clear the storage.
     */
    public function clear(): void;

    /**
     * Get all the values from the storage.
     */
    public function all(): array;

    /**
     * Get the path to the storage.
     */
    public function path(): string;
}
