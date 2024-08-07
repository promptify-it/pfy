<?php

namespace Pfy\Core\Loaders;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;
use Pfy\Core\Contracts\Loader;
use Pfy\Core\Data\CommandData;
use Pfy\Core\Facades\PersistentStorage;

class RemoteLoader implements Loader
{
    public function loadCommands(): Collection
    {
        $token = PersistentStorage::get('token');

        if (! $token) {
            return collect([]);
        }

        $response = Http::withToken($token)
            ->withoutVerifying()
            ->acceptJson()
            ->get(config('promptify-it.client.url').'/api/v1/commands');

        if ($response->json() == null) {
            return collect([]);
        }

        return collect($response->json())->map(function ($command) {
            return CommandData::from($command);
        });
    }
}
