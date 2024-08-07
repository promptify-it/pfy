<?php

it('can instanciate', function () {
    $commandOptionsData = Pfy\Core\Data\CommandOptionsData::from([]);

    expect($commandOptionsData)->toBeInstanceOf(Pfy\Core\Data\CommandOptionsData::class);
});

it('can instanciate with shouldLoadDotenv', function () {
    $commandOptionsData = Pfy\Core\Data\CommandOptionsData::from([
        'shouldLoadDotenv' => false,
    ]);

    expect($commandOptionsData->shouldLoadDotenv)->toBeFalse();
});
