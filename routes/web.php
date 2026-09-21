<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\PengurusController;

Route::get('/', function () {
    // Return events to landing page
    $events = \App\Models\Event::orderBy('event_date', 'asc')->get();
    return view('welcome', compact('events'));
});

Route::get('/pengurus', [PengurusController::class, 'index'])->name('pengurus');

Route::get('/events/{slug}', function ($slug) {
    $event = \App\Models\Event::where('slug', $slug)->firstOrFail();
    return view('events.show', compact('event'));
})->name('events.show');

// Admin panel handled by Filament

// Admin panel handled by Filament

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
