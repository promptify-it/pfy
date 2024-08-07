<?php

namespace Pfy\Core\Facades;

use Illuminate\Support\Facades\Facade;
use Pfy\Core\Contracts\PersistentStorage as PersistentStorageContract;

/**
 * @see \Pfy\Core\PersistentStorage
 *
 * @method static void set(string $key, $value)
 * @method static mixed get(string $key, $default = null)
 * @method static bool has(string $key)
 * @method static void remove(string $key)
 * @method static void clear()
 * @method static array all()
 * @method static string path()
 */
class PersistentStorage extends Facade
{
    protected static function getFacadeAccessor()
    {
        return PersistentStorageContract::class;
    }
}
