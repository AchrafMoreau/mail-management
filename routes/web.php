<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DestinationController;
use App\Http\Controllers\ExpediteurController;
use App\Http\Controllers\CourrireController;
use App\Http\Controllers\FileUploadController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\DechargeController;
use App\Http\Controllers\TempFileController;
use App\Http\Controllers\EmetteurController;
use Illuminate\Support\Facades\Route;

Route::get('index/{locale}', [App\Http\Controllers\HomeController::class, 'lang']);
Route::get('/', [App\Http\Controllers\HomeController::class, 'root'])->name('root');

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');


Route::middleware(['auth', 'clearNotification'])->group(function () {

    Route::resource("/courrire", CourrireController::class);
    Route::get("/entrant-courrire", [CourrireController::class, "entantCourrire"]);
    Route::get("/sortant-courrire", [CourrireController::class, "sortantCourrire"]);
    Route::delete("/courrire-deleteMany", [CourrireController::class, "deleteMany"]);
    Route::post("/courrie-filter", [CourrireController::class, "courrieFilter"]);


    Route::resource("/mail", MailController::class);
    Route::get("/entrant-mail", [MailController::class, "entantMail"]);
    Route::get("/sortant-mail", [MailController::class, "sortantMail"]);
    Route::delete("/mail-deleteMany", [MailController::class, "deleteMany"]);
    Route::post("/mail-filter", [MailController::class, "courrieFilter"]);

    
    Route::resource("/decharge", DechargeController::class);
    Route::delete("/decharge-deleteMany", [DechargeController::class, 'deleteMany']);
    Route::get("/dechargeJson", [DechargeController::class, 'json']);

    Route::resource("/emetteur", EmetteurController::class);
    Route::delete("/emetteur-deleteMany", [EmetteurController::class, 'deleteMany']);
    Route::get("/emetteurJson", [EmetteurController::class, 'json']);

    Route::controller(TempFileController::class)->group(function(){
        Route::match(['post','delete'],'/uploads','index');
    });

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/entrant-mail-persentage', [MailController::class, 'getEntrantMailPersentage']);
    Route::get('/sortant-mail-persentage', [MailController::class, 'getSortantMailPersentage']);
    Route::get('/entrant-courrier-persentage', [CourrireController::class, 'getEntrantMailPersentage']);
    Route::get('/sortant-courrier-persentage', [CourrireController::class, 'getSortantMailPersentage']);


    Route::resource('/setting', SettingController::class);
    Route::resource('/destination', DestinationController::class);
    Route::resource('/expediteur', ExpediteurController::class);
});

require __DIR__.'/auth.php';
