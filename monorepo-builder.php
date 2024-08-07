<?php

declare(strict_types=1);

use Symplify\MonorepoBuilder\ComposerJsonManipulator\ValueObject\ComposerJsonSection;
use Symplify\MonorepoBuilder\Config\MBConfig;

return static function (MBConfig $mbConfig): void {
    $mbConfig->packageDirectories([
        __DIR__.'/packages',
        __DIR__.'/apps',
    ]);

    // what extra parts to add after merge?
    $mbConfig->dataToAppend([
        ComposerJsonSection::AUTOLOAD_DEV => [
            'psr-4' => [
                'Symplify\Tests\\' => 'tests',
            ],
        ],
        ComposerJsonSection::REQUIRE_DEV => [
            'pestphp/pest' => '^2.0',
            'pestphp/pest-plugin-laravel' => '^2.0',
            'laravel/pint' => '^1.13',
            'mockery/mockery' => '^1.6',
        ],
    ]);
};
