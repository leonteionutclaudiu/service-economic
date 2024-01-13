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

Route::get('/', function () {
    return view('welcome');
});

Route::get('contact', [\App\Http\Controllers\ContactDisplayController::class, 'show'])->name('contact');
Route::post('/send-mail', [ContactFormController::class,'submitForm'])->name('send_contact_mail');
