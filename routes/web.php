<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\CourrierController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DechargeController;
use App\Http\Controllers\HomeController;

// Route pour afficher la liste des courriers

Route::middleware("admin")->group(function() {

    Route::get('/gestion_courrier', [PageController::class, 'gestionCourriers'])->name('gestion_courrier');
    Route::get('/search-courriers', [CourrierController::class, 'search'])->name('courriers.search');
    Route::get('/historique-courriers', [CourrierController::class, 'historique'])->name('historique_courriers');
    Route::resource('/courriers', CourrierController::class)->names([
        'index' => 'courriers.index',
        'create' => 'courriers.create',
        'store' => 'courriers.store',
        'edit' => 'courriers.edit',
        'update' => 'courriers.update',
        'destroy' => 'courriers.destroy',
        'show' => 'courriers.show'
    ]);

    Route::get('/gestion_decharges', [PageController::class, 'gestionDecharges'])->name('gestion_decharges');
    Route::get('/decharges/search', [DechargeController::class, 'search'])->name('decharges.search');
    Route::get('/historique_decharges', [DechargeController::class, 'historique'])->name('historique_decharges');
    Route::resource("/decharges", DechargeController::class)->names([
        'create' => 'decharges.create',
        'store' => 'decharges.store',
        'edite' => "decharges.edit",
        'update' => "decharges.update",
        'destory' => "decharges.destroy",
        'index' => 'decharges.index',
        'show' => "decharges.show",
    ]);

    Route::get('/', function () {
        return view('pagepremier');
    })->name('pagepremier');

    Route::get('/historique', [PageController::class, 'historique'])->name('historique');
    Route::get('/home', [HomeController::class, 'getStats'])->name('home');
});

// Route pour afficher la page d'accueil après la connexion

// Route POST pour traiter la redirection après la connexion
Route::post('/pagepremier', function () {
    return view('pagepremier');
})->name('pagepremier.post');

// Route::get('/', [DashboardController::class, 'index'])->name("dashboard");


// Route pour afficher les statistiques

// Route::get('/decharges/{id}', [DechargeController::class, 'show'])->name('decharges.show');

// Routes pour les autres pages gérées par PageController


require __DIR__.'/auth.php';


    // Route::get('/courriers', [CourrierController::class, 'index'])->name('courriers.index');

    // Route::get('/courriers/creat', [CourrierController::class, 'create'])->name('courriers.creat');
    // Route::post('/courriers', [CourrierController::class, 'store'])->name('courriers.store');
    // Route::get('/courriers/create', [CourrierController::class, 'create'])->name('courriers.create');

    // Route::get('/courriers/{id}/edit', [CourrierController::class, 'edit'])->name('courriers.edit');

    // Route::put('/courriers/{id}', [CourrierController::class, 'update'])->name('courriers.update');

    // Route::delete('/courriers/{id}', [CourrierController::class, 'destroy'])->name('courriers.destroy');
    // Route::get('/courriers/{id}', [CourrierController::class, 'show'])->name('courriers.show');

    // Route::get('/decharges/create', [DechargeController::class, 'create'])->name('decharges.create');

    // Route::post('/decharges', [DechargeController::class, 'store'])->name('decharges.store');

    // Route::get('/decharges/{id}/edit', [DechargeController::class, 'edit'])->name('decharges.edit');

    // Route::put('/decharges/{id}', [DechargeController::class, 'update'])->name('decharges.update');
    // Route::delete('/decharges/{id}', [DechargeController::class, 'destroy'])->name('decharges.destroy');

    // Route::get('/decharges', [DechargeController::class, 'index'])->name('decharges.index');