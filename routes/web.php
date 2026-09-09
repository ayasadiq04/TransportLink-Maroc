<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\MissionController;
use App\Http\Controllers\OfferController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\TransportRequestController;
use App\Http\Controllers\VehicleController;
use Illuminate\Support\Facades\Route;

// ─── Page d'accueil ───────────────────────────────────────────────────────────
Route::get('/', function () {
    return view('welcome');
});

// ─── Formulaire de contact ────────────────────────────────────────────────────
Route::post('/contact', [ContactController::class, 'send'])->name('contact.send');

// ─── Dashboard (redirige selon le rôle) ───────────────────────────────────────
Route::get('/dashboard', function () {
    $role = auth()->user()->role;

    if ($role === 'admin') {
        return redirect()->route('admin.dashboard');
    } elseif ($role === 'transporteur') {
        return redirect()->route('transporteur.dashboard');
    } else {
        return redirect()->route('client.dashboard');
    }
})->middleware(['auth', 'verified'])->name('dashboard');

// ─── Profil ──────────────────────────────────────────────────────────────────
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// ─── CLIENT ──────────────────────────────────────────────────────────────────
Route::middleware(['auth', 'role:client'])->prefix('client')->name('client.')->group(function () {

    // Dashboard client
    Route::get('/dashboard', function () {
        $user = auth()->user();
        $stats = [
            'requests'          => $user->transportRequests()->count(),
            'pending_requests'  => $user->transportRequests()->where('status', 'pending')->count(),
            'missions'          => $user->missionsAsClient()->count(),
            'active_missions'   => $user->missionsAsClient()->whereIn('status', ['pending', 'accepted', 'in_delivery'])->count(),
        ];
        $recentRequests = $user->transportRequests()->latest()->limit(3)->get();
        $recentMissions = $user->missionsAsClient()->with('transporteur')->latest()->limit(3)->get();
        return view('client.dashboard', compact('stats', 'recentRequests', 'recentMissions'));
    })->name('dashboard');

    // Demandes de transport
    Route::get('/transport-requests', [TransportRequestController::class, 'index'])->name('transport-requests.index');
    Route::get('/transport-requests/create', [TransportRequestController::class, 'create'])->name('transport-requests.create');
    Route::post('/transport-requests', [TransportRequestController::class, 'store'])->name('transport-requests.store');
    Route::get('/transport-requests/{transportRequest}', [TransportRequestController::class, 'show'])->name('transport-requests.show');
    Route::get('/transport-requests/{transportRequest}/edit', [TransportRequestController::class, 'edit'])->name('transport-requests.edit');
    Route::put('/transport-requests/{transportRequest}', [TransportRequestController::class, 'update'])->name('transport-requests.update');
    Route::delete('/transport-requests/{transportRequest}', [TransportRequestController::class, 'destroy'])->name('transport-requests.destroy');

    // Offres reçues
    Route::get('/offers', [OfferController::class, 'clientOffers'])->name('offers.index');
    Route::post('/offers/{offer}/accept', [OfferController::class, 'accept'])->name('offers.accept');
    Route::post('/offers/{offer}/reject', [OfferController::class, 'reject'])->name('offers.reject');

    // Missions
    Route::get('/missions', [MissionController::class, 'clientIndex'])->name('missions.index');
    Route::get('/missions/{mission}', [MissionController::class, 'clientShow'])->name('missions.show');

    // Évaluations
    Route::get('/missions/{mission}/review', [ReviewController::class, 'create'])->name('reviews.create');
    Route::post('/missions/{mission}/review', [ReviewController::class, 'store'])->name('reviews.store');
});

// ─── TRANSPORTEUR ─────────────────────────────────────────────────────────────
Route::middleware(['auth', 'role:transporteur'])->prefix('transporteur')->name('transporteur.')->group(function () {

    // Dashboard transporteur
    Route::get('/dashboard', function () {
        $user = auth()->user();
        $stats = [
            'vehicles'         => $user->vehicles()->count(),
            'available_vehicles' => $user->vehicles()->where('available', true)->count(),
            'offers'           => $user->offers()->count(),
            'pending_offers'   => $user->offers()->where('status', 'pending')->count(),
            'missions'         => $user->missionsAsTransporteur()->count(),
            'active_missions'  => $user->missionsAsTransporteur()->whereIn('status', ['pending', 'accepted', 'in_delivery'])->count(),
            'average_rating'   => $user->averageRating(),
            'total_reviews'    => $user->reviewsReceived()->count(),
        ];
        $recentMissions = $user->missionsAsTransporteur()->with('client')->latest()->limit(3)->get();
        $availableRequests = \App\Models\TransportRequest::where('status', 'pending')->count();
        return view('transporteur.dashboard', compact('stats', 'recentMissions', 'availableRequests'));
    })->name('dashboard');

    // Véhicules
    Route::resource('vehicles', VehicleController::class)->except(['show']);

    // Demandes disponibles
    Route::get('/requests', [TransportRequestController::class, 'availableForTransporteur'])->name('requests.index');
    Route::get('/requests/{transportRequest}', [TransportRequestController::class, 'showForTransporteur'])->name('requests.show');

    // Offres
    Route::get('/offers', [OfferController::class, 'index'])->name('offers.index');
    Route::get('/offers/{offer}', [OfferController::class, 'show'])->name('offers.show');
    Route::get('/requests/{transportRequest}/offer', [OfferController::class, 'create'])->name('offers.create');
    Route::post('/requests/{transportRequest}/offer', [OfferController::class, 'store'])->name('offers.store');

    // Missions
    Route::get('/missions', [MissionController::class, 'transporteurIndex'])->name('missions.index');
    Route::get('/missions/{mission}', [MissionController::class, 'transporteurShow'])->name('missions.show');
    Route::post('/missions/{mission}/status', [MissionController::class, 'updateStatus'])->name('missions.update-status');
});

// ─── ADMIN ────────────────────────────────────────────────────────────────────
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/users', [AdminController::class, 'users'])->name('users.index');
    Route::delete('/users/{user}', [AdminController::class, 'destroyUser'])->name('users.delete');
    Route::get('/transport-requests', [AdminController::class, 'transportRequests'])->name('transport-requests.index');
    Route::get('/transport-requests/{transportRequest}', [AdminController::class, 'showTransportRequest'])->name('transport-requests.show');
    Route::get('/offers', [AdminController::class, 'offers'])->name('offers.index');
    Route::get('/missions', [AdminController::class, 'missions'])->name('missions.index');
    Route::get('/reviews', [AdminController::class, 'reviews'])->name('reviews.index');
    Route::delete('/reviews/{review}', [AdminController::class, 'destroyReview'])->name('reviews.delete');
});

// ─── Profil public transporteur (accessible à tous les authentifiés) ──────────
Route::middleware('auth')->get('/transporteurs/{id}/profile', [ReviewController::class, 'transporteurProfile'])
    ->name('transporteur.profile');

require __DIR__.'/auth.php';
