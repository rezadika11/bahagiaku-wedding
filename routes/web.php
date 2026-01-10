<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Laravel\Fortify\Features;
use App\Http\Controllers\Admin\ClientController;
use App\Http\Controllers\Admin\InvitationController;
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\Admin\GuestController;

Route::get('/', function () {
    return Inertia::render('Home', [
        'canLogin' => Route::has('login'),
    ]);
})->name('home');

Route::get('dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


require __DIR__ . '/settings.php';



Route::middleware(['auth', 'verified'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('clients', ClientController::class);
    Route::resource('invitations', InvitationController::class);

    // Sub-resources managed via API or within Invitation page
    Route::resource('events', EventController::class)->only(['store', 'update', 'destroy']);
    Route::resource('guests', GuestController::class)->only(['store', 'update', 'destroy']);

    // Broadcast Feature
    Route::post('guests/{guest}/broadcast', [GuestController::class, 'generateBroadcast'])->name('guests.broadcast');
});
