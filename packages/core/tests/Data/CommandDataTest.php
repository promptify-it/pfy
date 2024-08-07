<?php

it('can instanciate', function () {
    $commandData = Pfy\Core\Data\CommandData::from([
        'id' => 'eeb1b3b1-0b3b-4b1b-8b1b-0b3b1b3b1b3b',
        'signature' => 'signature',
        'description' => 'description',
        'root' => [
            'nodes' => [],
        ],
    ]);

    expect($commandData)->toBeInstanceOf(Pfy\Core\Data\CommandData::class);
});

it('can instanciate without options', function () {
    $commandData = Pfy\Core\Data\CommandData::from([
        'id' => 'eeb1b3b1-0b3b-4b1b-8b1b-0b3b1b3b1b3b',
        'signature' => 'signature',
        'description' => 'description',
        'root' => [
            'nodes' => [],
        ],
    ]);

    expect($commandData->options)->toBeInstanceOf(Pfy\Core\Data\CommandOptionsData::class);
    expect($commandData->options->shouldLoadDotenv)->toBeTrue();
});

it('can instanciate with options', function () {
    $commandData = Pfy\Core\Data\CommandData::from([
        'id' => 'eeb1b3b1-0b3b-4b1b-8b1b-0b3b1b3b1b3b',
        'signature' => 'signature',
        'description' => 'description',
        'root' => [
            'nodes' => [],
        ],
        'options' => [
            'shouldLoadDotenv' => false,
        ],
    ]);

    expect($commandData->options->shouldLoadDotenv)->toBeFalse();
});

it('can instanciate with empty options', function () {
    $commandData = Pfy\Core\Data\CommandData::from([
        'id' => 'eeb1b3b1-0b3b-4b1b-8b1b-0b3b1b3b1b3b',
        'signature' => 'signature',
        'description' => 'description',
        'root' => [
            'nodes' => [],
        ],
        'options' => [
            'workingDirectory' => __DIR__,
        ],
    ]);

    expect($commandData->options->shouldLoadDotenv)->toBeTrue();
});
