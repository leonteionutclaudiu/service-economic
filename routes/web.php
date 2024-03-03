<?php

use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\BillingAddressController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\FavoritesController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ContactFormController;
use App\Http\Controllers\ProductDisplayController;
use App\Http\Controllers\ProgramareController;
use App\Http\Controllers\ShippingAddressController;
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

Route::get('/', [\App\Http\Controllers\HomeDisplayController::class, 'show'])->name('acasa');
Route::get('oferte', [ProductDisplayController::class, 'showOffersProducts'])->name('offers-products');
Route::get('articole', [\App\Http\Controllers\NoutatiDisplayController::class, 'index'])->name('noutati-all');
Route::get('articole/{slug}', [\App\Http\Controllers\NoutatiDisplayController::class, 'show'])->name('noutati');
Route::get('despre-noi', [\App\Http\Controllers\EchipaDisplayController::class, 'show_despre_noi'])->name('despre-noi');
Route::get('echipa', [\App\Http\Controllers\EchipaDisplayController::class, 'show_echipa'])->name('echipa');
Route::get('cariera', [\App\Http\Controllers\EchipaDisplayController::class, 'show_cariera'])->name('cariera');
Route::get('intrebari-frecvente', [\App\Http\Controllers\EchipaDisplayController::class, 'show_intrebari_frecvente'])->name('intrebari-frecvente');
Route::get('contact', [\App\Http\Controllers\ContactDisplayController::class, 'show'])->name('contact');
Route::post('send-mail', [ContactFormController::class,'submitForm'])->name('send_contact_mail');

Route::get('/programare', [ProgramareController::class, 'showForm']);
Route::post('/programare', [ProgramareController::class, 'store']);

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/utilizatori', [RegisteredUserController::class, 'index'])->name('users.index');
    Route::get('/programari', [ProgramareController::class, 'showProgramari']);
    Route::patch('/programari/{programare}/acceptata', [ProgramareController::class, 'updateAcceptata'])->name('update.acceptata');
    Route::get('/utilizatori/{user}/edit-roluri', [RegisteredUserController::class, 'edit'])->name('user.edit');
    Route::patch('/utilizatori/{user}/update-roluri', [RegisteredUserController::class, 'update'])->name('user.update-roluri');
});

Route::get('products/{tag}', [ProductDisplayController::class, 'showProductsByTag'])->name('products-by-tag');
Route::get('product/{slug}', [ProductDisplayController::class, 'showProduct'])->name('product');
Route::get('search', [ProductDisplayController::class, 'search'])->name('search');

Route::group(['middleware' => ['auth']], function () {
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart', [CartController::class, 'store'])->name('cart.store');
    Route::put('/cart/{id}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/{id}', [CartController::class, 'destroy'])->name('cart.destroy');
    Route::get('/cart/count', [CartController::class, 'getCartItemCount']);
    Route::get('/checkout', [CheckoutController::class, 'index']);

    Route::get('/favorites', [FavoritesController::class, 'index'])->name('favorites.index');
    Route::post('/favorites', [FavoritesController::class, 'store'])->name('favorites.store');
    Route::delete('/favorites/{id}', [FavoritesController::class, 'destroy'])->name('favorites.destroy');
    Route::get('/favorites/count', [FavoritesController::class, 'getFavoritesItemCount']);
});

// API routes
Route::get('/api/categories', [ProductDisplayController::class, 'getCategories']);

Route::middleware('auth')->group(function () {
    Route::get('/comenzi', [ProfileController::class, 'getOrders'])->name('profile.orders');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('address/shipping', [ShippingAddressController::class, 'editShippingAddress'])->name('address.shipping.edit');
    Route::patch('address/shipping', [ShippingAddressController::class, 'updateShippingAddress'])->name('address.shipping.update');

    Route::get('address/billing', [BillingAddressController::class, 'editBillingAddress'])->name('address.billing.edit');
    Route::patch('address/billing', [BillingAddressController::class, 'updateBillingAddress'])->name('address.billing.update');
    });

Route::fallback(function () {
    return redirect('/');
});

require __DIR__.'/auth.php';
