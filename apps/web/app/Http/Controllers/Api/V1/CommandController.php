<?php

namespace Pfy\Web\Http\Controllers\Api\V1;

use Pfy\Web\Http\Controllers\Controller;

class CommandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = request()->user();

        $teams = $user->allTeams();

        $signatures = [];

        $commands = $teams->map(function ($team) use (&$signatures) {
            return $team->commands->map(function ($command) use ($team, &$signatures) {
                if (in_array($command->signature, $signatures)) {
                    $command->signature = $this->tryToAddIncrementalSuffix($command->signature, $signatures);
                }

                $command->description = $command->description.' - '.$team->name;

                $signatures[] = $command->signature;

                return $command;
            });
        })->flatten();

        return $commands;
    }

    private function tryToAddIncrementalSuffix($signature, $signatures)
    {
        $suffix = 1;

        while (in_array($signature.':'.$suffix, $signatures)) {
            $suffix++;
        }

        return $signature.':'.$suffix;
    }
}
