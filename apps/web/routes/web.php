<?php

use Pfy\Web\Http\Controllers\Inertia\CommandController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('commands', [CommandController::class, 'index'])->name('command.index');
    Route::get('commands/create', [CommandController::class, 'create'])->name('command.create');
    Route::post('commands/create', [CommandController::class, 'store'])->name('command.store');
    Route::get('commands/{command}', [CommandController::class, 'show'])->name('command.show');
    Route::get('commands/{command}/edit', [CommandController::class, 'edit'])->name('command.edit');
    Route::put('commands/{command}', [CommandController::class, 'update'])->name('command.update');
    Route::delete('commands/{command}', [CommandController::class, 'destroy'])->name('command.destroy');

    Route::get('docs', function () {
        return Inertia::render('Docs', [
            'content' => file_get_contents(base_path('README.md')),
        ]);
    })->name('docs.index');
});
