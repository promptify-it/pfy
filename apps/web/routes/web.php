<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Pfy\Web\Http\Controllers\Inertia\CommandController;

Route::get('/', function () {
    return Inertia::render('Welcome');
})->name('welcome');

Route::get('/marketplace', function () {
    return Inertia::render('Marketplace');
})->name('marketplace');

Route::get('privacy-policy', function () {
    return Inertia::render('PrivacyPolicy');
})->name('policy.show');

Route::get('terms-of-service', function () {
    return Inertia::render('TermsOfService');
})->name('terms.show');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('commands', [CommandController::class, 'index'])->name('command.index');
    Route::get('commands/create', [CommandController::class, 'create'])->name('command.create');
    Route::post('commands/create', [CommandController::class, 'store'])->name('command.store');
    Route::get('commands/{command}', [CommandController::class, 'show'])->name('command.show');
    Route::post('commands/{command}/clone', [CommandController::class, 'clone'])->name('command.clone');
    Route::get('commands/{command}/edit', [CommandController::class, 'edit'])->name('command.edit');
    Route::put('commands/{command}', [CommandController::class, 'update'])->name('command.update');
    Route::delete('commands/{command}', [CommandController::class, 'destroy'])->name('command.destroy');
});
