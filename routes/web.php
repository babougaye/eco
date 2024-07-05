<?php

use Illuminate\Support\Facades\Route;
use Laravel\Jetstream\Rules\Role;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Models\Panier;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [HomeController::class, 'index']);

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
Route::get('/panier/count', function() {
    return response()->json(['count' => Panier::count()]);
});

Route::get('/redirect', [HomeController::class, 'redirect']);
Route::get('/Voir_category', [AdminController::class, 'Voir_category']);
Route::post('/ajout_category', [AdminController::class, 'ajout_category']);
Route::get('/delete_categorie/{id}', [AdminController::class, 'delete_categorie']);
Route::get('/Voir_produit', [AdminController::class, 'Voir_produit']);
Route::post('/ajout_produit', [AdminController::class, 'ajout_produit']);
Route::get('/show_produit', [AdminController::class, 'show_produit']);
Route::get('/supprimer_produit/{id}', [AdminController::class, 'supprimer_produit']);
Route::get('/modifier_produit/{id}', [AdminController::class, 'modifier_produit']);
Route::post('/modifier_produit_confirm/{id}', [AdminController::class, 'modifier_produit_confirm']);
Route::get('/produit_details/{id}', [HomeController::class, 'produit_details']);
Route::post('/Ajouter_panier/{id}', [HomeController::class, 'Ajouter_panier']);
Route::get('/show_panier', [HomeController::class, 'show_panier']);
Route::get('/order', [AdminController::class, 'order']);
Route::get('/remove_panier/{id}', [HomeController::class, 'remove_panier']);
Route::get('/cash_order', [HomeController::class, 'cash_order']);
Route::get('/stripe/{totalprix}', [HomeController::class, 'stripe']);
Route::post('stripe/{totalprix}',[HomeController::class,  'stripePost'])->name('stripe.post');
// New routes for Wave and Orange Money
Route::get('wave_payment/{totalprix}', [HomeController::class, 'wavePayment'])->name('wave.payment');
Route::post('wave_payment/{totalprix}', [HomeController::class, 'wavePaymentPost'])->name('wave.post');

Route::get('orange_money_payment/{totalprix}', [HomeController::class, 'orangeMoneyPayment'])->name('orange_money.payment');
Route::post('orange_money_payment/{totalprix}', [HomeController::class, 'orangeMoneyPaymentPost'])->name('orange_money.post');

Route::get('/delivered/{id}', [AdminController::class, 'delivered']);
Route::get('/print_pdf/{id}', [AdminController::class, 'print_pdf']);
Route::get('/envoyer_email/{id}', [AdminController::class, 'envoyer_email']);
Route::post('/send_user_email/{id}', [AdminController::class, 'send_user_email']);
Route::get('/search', [AdminController::class, 'searchdata']);
Route::get('/show_order', [HomeController::class, 'show_order']);
Route::get('/cancel_order/{id}', [HomeController::class, 'cancel_order']);
Route::get('/serach_produits', [HomeController::class, 'serach_produit']);
Route::get('/all_produits', [HomeController::class, 'produit']);
Route::get('/produits_search', [HomeController::class, 'produit_search']);
Route::get('/panier', [HomeController::class, 'show_panier'])->name('show_panier');
Route::get('/cart/count', [HomeController::class, 'cartCount'])->name('cart.count');

Route::get('/contact_nous', [HomeController::class, 'contact_nous']);
Route::get('/blog', [HomeController::class, 'blog']);

