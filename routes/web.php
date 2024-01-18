<?php

use App\Http\Controllers\ContactFormController;
use App\Http\Controllers\Twill\ContactController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('acasa', [\App\Http\Controllers\HomeDisplayController::class, 'show'])->name('acasa');
Route::get('/', function () {
    return redirect('/acasa');
});
Route::get('noutati', [\App\Http\Controllers\NoutatiDisplayController::class, 'index'])->name('noutati-all');
Route::get('noutati/{slug}', [\App\Http\Controllers\NoutatiDisplayController::class, 'show'])->name('noutati');
Route::get('despre-noi', [\App\Http\Controllers\EchipaDisplayController::class, 'show_despre_noi'])->name('despre-noi');
Route::get('echipa', [\App\Http\Controllers\EchipaDisplayController::class, 'show_echipa'])->name('echipa');
Route::get('cariera', [\App\Http\Controllers\EchipaDisplayController::class, 'show_cariera'])->name('cariera');
Route::get('intrebari-frecvente', [\App\Http\Controllers\EchipaDisplayController::class, 'show_intrebari_frecvente'])->name('intrebari-frecvente');
Route::get('contact', [\App\Http\Controllers\ContactDisplayController::class, 'show'])->name('contact');
Route::post('send-mail', [ContactFormController::class,'submitForm'])->name('send_contact_mail');
