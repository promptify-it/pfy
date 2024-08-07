<?php

namespace Pfy\Core;

use Pfy\Core\PersistentStorage\JsonPersistentStorage;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class PromptifyItServiceProvider extends PackageServiceProvider
{
    /**
     * Configure the package.
     */
    public function configurePackage(Package $package): void
    {
        $package
            ->name('promptify-it')
            ->hasConfigFile();
    }

    /**
     * Register the package services.
     */
    public function registeringPackage()
    {
        $this->bindServices();
    }

    /**
     * Bind the services.
     * Automatically call each method that starts with "bind".
     */
    protected function bindServices(): void
    {
        collect(get_class_methods($this))
            ->filter(fn ($method) => str_starts_with($method, 'bind'))
            ->filter(fn ($method) => $method !== 'bindServices')
            ->each(fn ($method) => $this->$method());
    }

    /**
     * Bind the authenticator.
     */
    public function bindAuthenticator(): self
    {
        $this->app->bind(Contracts\Authenticator::class, Authenticator::class);

        return $this;
    }

    /**
     * Bind the command factory.
     */
    protected function bindCommandFactory(): self
    {
        $this->app->bind(Contracts\CommandFactory::class, CommandFactory::class);

        return $this;
    }

    /**
     * Bind the data piper.
     */
    protected function bindDataPiper(): self
    {
        $this->app->bind(Contracts\DataPiper::class, DataPipers\DataPiper::class);

        return $this;
    }

    /**
     * Bind the loader.
     */
    public function bindLoader(): self
    {
        $this->app->bind(Contracts\Loader::class, Loaders\RemoteLoader::class);

        return $this;
    }

    public function bindNodesUsingType(): self
    {
        $nodeClasses = $this->autoloadNodes();

        $this->app->bind('promptify-it.nodes', fn () => $nodeClasses);

        return $this;
    }

    /**
     * Bind the persistent storage.
     */
    public function bindPersistentStorage(): self
    {
        $this->app->singleton(Contracts\PersistentStorage::class, JsonPersistentStorage::class);

        return $this;
    }

    /**
     * Bind the transverser.
     */
    protected function bindTransverser(): self
    {
        $this->app->bind(Contracts\Transverser::class, Transverser::class);

        return $this;
    }

    /**
     * Autoload the nodes scanning recursively the nodes directory.
     */
    private function autoloadNodes(): array
    {
        $nodes = [];

        $directory = __DIR__.'/Data/Nodes';

        $files = scandir($directory);

        foreach ($files as $file) {
            if ($file == '.' || $file == '..') {
                continue;
            }

            if (is_file($directory.'/'.$file)) {
                continue;
            }

            $nodes[str($file)->camel()->toString()] = [
                'nodeData' => 'PromptifyIt\\PromptifyIt\\Data\\Nodes\\'.$file.'\\'.$file.'NodeData',
                'nodeContentData' => 'PromptifyIt\\PromptifyIt\\Data\\Nodes\\'.$file.'\\'.$file.'NodeContentData',
            ];
        }

        return $nodes;
    }
}
