<?php

it('can instanciate', function () {
    $commandOptionsData = Pfy\Core\Data\Nodes\Assign\AssignNodeData::from([
        'content' => [
            'key' => 'key',
            'value' => 'value',
        ],
    ]);

    expect($commandOptionsData)->toBeInstanceOf(Pfy\Core\Data\Nodes\Assign\AssignNodeData::class);

    expect($commandOptionsData->content->key)->toBe('key');
    expect($commandOptionsData->content->value)->toBe('value');
});
