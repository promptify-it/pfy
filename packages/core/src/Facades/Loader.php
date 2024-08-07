<?php

namespace Pfy\Core\Facades;

use Illuminate\Support\Facades\Facade;
use Pfy\Core\Contracts\Loader as LoaderContract;

/**
 * @see \Pfy\Core\Contracts\Commands\Loader
 *
 * @method static \Illuminate\Support\Collection loadCommands()
 */
class Loader extends Facade
{
    protected static function getFacadeAccessor()
    {
        return LoaderContract::class;
    }
}
