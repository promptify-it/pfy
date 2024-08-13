<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Pfy\Web\Http\Controllers\Inertia\CommandController;

Route::get('/', function () {
    return Inertia::render('Welcome');
})->name('welcome');

Route::get('privacy-policy', function () {
    return Inertia::render('PrivacyPolicy');
})->name('privacy-policy');

Route::get('terms-of-service', function () {
    return Inertia::render('TermsOfService');
})->name('terms-of-service');

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
});
