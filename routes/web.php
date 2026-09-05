<?php
use App\Http\Controllers\TransportRequestController;
use App\Http\Controllers\OfferController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'role:client'])->group(function () {

    Route::get('/transport-requests', [TransportRequestController::class, 'index'])
        ->name('transport-requests.index');

    Route::get('/transport-requests/create', [TransportRequestController::class, 'create'])
        ->name('transport-requests.create');

    Route::post('/transport-requests', [TransportRequestController::class, 'store'])
        ->name('transport-requests.store');

    Route::get('/transport-requests/{transportRequest}/edit', [TransportRequestController::class, 'edit'])
        ->name('transport-requests.edit');

    Route::put('/transport-requests/{transportRequest}', [TransportRequestController::class, 'update'])
        ->name('transport-requests.update');

    Route::delete('/transport-requests/{transportRequest}', [TransportRequestController::class, 'destroy'])
        ->name('transport-requests.destroy');

});
Route::middleware(['auth', 'role:transporteur'])->group(function () {
    Route::get(
    '/available-transport-requests',
    [TransportRequestController::class, 'available']
    )->name('transport-requests.available');
    Route::resource('vehicles', VehicleController::class)
        ->except(['show']);
    Route::get(
        '/transport-requests/{transportRequest}/offer',
        [OfferController::class, 'create']
    )->name('offers.create');

    Route::post(
        '/transport-requests/{transportRequest}/offer',
        [OfferController::class, 'store']
    )->name('offers.store');
});
require __DIR__.'/auth.php';
