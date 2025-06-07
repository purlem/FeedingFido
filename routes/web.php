<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ListingController;
use App\Http\Controllers\DashboardController;

use Illuminate\Support\Facades\Route;


// Public routes (anyone can view or create a listing)
Route::get('/', [ListingController::class, 'index'])->name('listings.index');
Route::get('/listings/create', [ListingController::class, 'create'])->name('listings.create');
Route::post('/listings', [ListingController::class, 'store'])->name('listings.store');
Route::get('/listings/thankyou', function () {
    return view('listings.thankyou');
})->name('listings.thankyou');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/listings/{listing}/edit', [ListingController::class, 'edit'])->name('listings.edit');
    Route::put('/listings/{listing}', [ListingController::class, 'update'])->name('listings.update');
    Route::delete('/listings/{listing}', [ListingController::class, 'destroy'])->name('listings.destroy');

    Route::post('/listings/{listing}/pickup', [ListingController::class, 'markAsPickedUp'])
        ->middleware(['auth'])
        ->name('listings.pickup');

    Route::get('/profile/{user}', [ProfileController::class, 'public'])->name('profile.public');
});


// Accept listing (only for recipients)
Route::post('/listings/{listing}/accept', [ListingController::class, 'accept'])
    ->middleware(['auth', 'role:recipient'])
    ->name('listings.accept');

Route::middleware(['auth', 'role:donor'])->group(function () {
    // Donor-only routes
});

Route::middleware(['auth', 'role:recipient'])->group(function () {
    // Recipient-only routes
});

require __DIR__.'/auth.php';
