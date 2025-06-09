<?php

use App\Http\Controllers\Admin\AdminAliController;
use App\Http\Controllers\Admin\AdminArpController;
use App\Http\Controllers\Admin\AdminATKController;
use App\Http\Controllers\Admin\AdminBSWController;
use App\Http\Controllers\Admin\AdminCarouselController;
use App\Http\Controllers\Admin\AdminCMSController;
use App\Http\Controllers\Admin\AdminDummyController;
use App\Http\Controllers\Admin\AdminFooterController;
use App\Http\Controllers\Admin\AdminKbtController;
use App\Http\Controllers\Admin\AdminKMActivityController;
use App\Http\Controllers\Admin\AdminLogoController;
use App\Http\Controllers\Admin\AdminOPController;
use App\Http\Controllers\Admin\AdminOrmawaController;
use App\Http\Controllers\Admin\AdminPenristekController;
use App\Http\Controllers\Admin\AdminPodcastsController;
use App\Http\Controllers\Admin\AdminProdukController;
use App\Http\Controllers\Admin\AdminSaiDataController;
use App\Http\Controllers\Admin\AdminTagATKController;
use App\Http\Controllers\Admin\AdminTransaksiController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Auth\DummyController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Client\ClientAliController;
use App\Http\Controllers\Client\ClientArpController;
use App\Http\Controllers\Client\ClientATKController;
use App\Http\Controllers\Client\ClientCartController;
use App\Http\Controllers\Client\ClientHomeController;
use App\Http\Controllers\Client\ClientKabinetController;
use App\Http\Controllers\Client\ClientKMActivityController;
use App\Http\Controllers\Client\ClientOPController;
use App\Http\Controllers\Client\ClientOrmawaController;
use App\Http\Controllers\Client\ClientPodcastController;
use App\Http\Controllers\Client\ClientProductController;
use App\Http\Controllers\Client\ClientSaiDataController;
use App\Http\Controllers\Client\ClientTagATKController;
use App\Http\Controllers\Client\OrmawaController;
use App\Http\Controllers\TransaksiController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

//use App\Http\Controllers\Client\OrmawaController;

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

Route::get('/', [ClientHomeController::class, 'index'])->name('beranda');

Auth::routes([
   'register' => false,
   'reset' => false,
   'verify' => false,
   'login' => false,
   'logout' => false,
]);
Route::get('/bootstrap', [LoginController::class, 'showLoginForm'])->name(
   'bootstrap'
);
Route::post('/bootstrap', [LoginController::class, 'login']);
Route::get('/login', [DummyController::class, 'index'])->name('login');
Route::post('/login', [DummyController::class, 'login']);
Route::get('/backup', [DummyController::class, 'backup'])->name('backup');
Route::get('/alur', [ClientOPController::class, 'indexAlur'])->name('alur');
Route::get('/kritiksaran', [ClientOPController::class, 'indexKritik'])->name('kritiksaran');


Route::controller(ClientSaiDataController::class)
   ->name('saidata.')
   ->prefix('saidata')
   ->group(function () {
      Route::get('/', 'index');
   });

// Route::get('/saidata/beasiswa', [ClientSaiDataController::class, 'bsw'])->name(
//     'bsws',
//     'link'
// );
// Route::get('/saidata/beasiswa/{slug}', [
//     ClientSaiDataController::class,
//     'bsw_detail',
// ])->name('bsws_detail');
// Route::get('/saidata/alumni', [ClientAliController::class, 'index'])->name(
//     'alumni',
//     'link'
// );

// Route::controller(ClientArpController::class)
//     ->name('arsip.')
//     ->prefix('/saidata/arsip')
//     ->group(function () {
//         Route::get('/', 'index');
//         Route::get('/{slug}', 'show');
//     });

Route::controller(ClientATKController::class)
   ->name('artikel.')
   ->prefix('artikel')
   ->group(function () {
      Route::get('/{slug}', 'show');
      Route::get('/', 'index');
   });

Route::get('/tag/{slug}', [ClientTagATKController::class, 'index'])->name(
   'tag'
);


Route::controller(ClientKMActivityController::class)->name('activity.')->prefix('activity')->group(function () {
   Route::get('/', 'index');
   Route::get('/{slug}', 'show');
});


Route::controller(ClientOPController::class)
   ->name('operasional.')
   ->prefix('operasional')
   ->group(function () {
      // Route::get('/', 'index');
      Route::get('/{kategori}', 'indexKategori');
      // Route::get('/{kategori}/{id}', 'show');
   });

Route::prefix('ecommerce')
   ->name('ecommerce.')
   ->group(function () {
      Route::get('/', [ClientProductController::class, 'index'])->name(
         'home'
      );
      Route::get('/order', [ClientCartController::class, 'order'])->name(
         'order'
      );
      Route::get('/product/{id}', [
         ClientProductController::class,
         'show',
      ])->name('product.show');
      Route::get('/cart', [ClientCartController::class, 'cart'])->name(
         'cart'
      );

      Route::post('/cart/add/{id}', [
         ClientCartController::class,
         'add',
      ])->name('cart.add');
      Route::put('/cart/update/{id}', [
         ClientCartController::class,
         'update',
      ])->name('cart.update');
      Route::delete('/cart/remove/{id}', [
         ClientCartController::class,
         'remove',
      ])->name('cart.remove');

      Route::name('transaksi.')
         ->prefix('transaksi')
         ->group(function () {
            Route::post('create', [
               TransaksiController::class,
               'createTransaction',
            ])->name('create');
            Route::get('/', [
               TransaksiController::class,
               'getTransactions',
            ])->name('get');
            Route::get('{id}', [
               TransaksiController::class,
               'getTransactionDetail',
            ])->name('transactionDetail');
         });

      Route::name('payment.')
         ->prefix('payments')
         ->group(function () {
            Route::get('updatePayment', [
               TransaksiController::class,
               'updatePayment',
            ])->name('updatePayment');
            Route::get('/', [
               TransaksiController::class,
               'getPayments',
            ])->name('get');
            Route::get('{id}', [
               TransaksiController::class,
               'getPaymentDetail',
            ])->name('paymentDetail');
         });
   });

// Ormawa
Route::get('/ormawa', [ClientOrmawaController::class, 'index'])->name('client.ormawa.index');
Route::get('/ormawa/{slug}', [ClientOrmawaController::class, 'show'])->name('client.ormawa.show');

// Podcast
Route::get('/podcasts', [ClientPodcastController::class, 'index'])->name(
   'podcasts.index'
);

Route::get('/kabinet/{slug}', [ClientKabinetController::class, 'show'])->name('kabinet');
Route::get('/tentang-km', [ClientKabinetController::class, 'index'])->name('tentang');

Route::middleware(['auth'])->group(function () {
   Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

   Route::middleware(['admin'])
      ->name('admin.')
      ->prefix('admin')
      ->group(function () {
         Route::resource('alumni', AdminAliController::class);
         Route::resource('arsip', AdminArpController::class);
         // tip: route tambahan di resource controller harus dipanggil sebelum resource controller itu sendiri
         // https://laravel.com/docs/10.x/controllers#restful-supplementing-resource-controllers
         Route::get('artikel/create-slug', [
            AdminATKController::class,
            'createSlug',
         ]);
         Route::get('artikel/check-slug', [
            AdminATKController::class,
            'checkSlug',
         ]);
         Route::resource('artikel', AdminATKController::class);
         Route::resource('tag-artikel', AdminTagATKController::class);
         Route::resource('penristek', AdminPenristekController::class);
         Route::resource('beasiswa', AdminBSWController::class);
         Route::resource('dummy', AdminDummyController::class);
         Route::resource('kabinet', AdminKbtController::class);
         Route::resource('operasional', AdminOPController::class);
         Route::resource('saidata', AdminSaiDataController::class);
         Route::resource('user', AdminUserController::class);
         Route::resource('cms', AdminCMSController::class);
         Route::post('ormawa/{slug}/{type}/order/{direction}', [
            AdminOrmawaController::class,
            'changeOrder',
         ])->name('ormawa.changeOrder');
         Route::get('ormawa/{slug}/{type}/edit', [
            AdminOrmawaController::class,
            'edit',
         ])->name('ormawa.edit');
         Route::put('ormawa/{slug}/{type}', [
            AdminOrmawaController::class,
            'update',
         ])->name('ormawa.update');
         Route::delete('ormawa/{slug}/{type}', [
            AdminOrmawaController::class,
            'destroy',
         ])->name('ormawa.destroy');
         Route::resource('ormawa', AdminOrmawaController::class)->except('edit', 'update', 'destroy');
         // ekraf - admin
         Route::resource('produk', AdminProdukController::class);
         Route::resource('transaksi', AdminTransaksiController::class);
         Route::resource('carousel', AdminCarouselController::class);
         Route::post('carousel/{carousel}/change-order', [
            AdminCarouselController::class,
            'changeOrder',
         ])->name('carousel.changeOrder');

         // activity
         Route::resource('km-activity', AdminKMActivityController::class);
         Route::get('km-activity/create-slug', [
            AdminATKController::class,
            'createSlug',
         ]);
         Route::get('km-activity/check-slug', [
            AdminATKController::class,
            'checkSlug',
         ]);

         Route::resource('footer', AdminFooterController::class);

         Route::resource('podcasts', AdminPodcastsController::class);
         Route::get('podcasts/{podcast}/move-up', [
            AdminPodcastsController::class,
            'moveUp',
         ])->name('podcasts.moveUp');
         Route::get('podcasts/{podcast}/move-down', [
            AdminPodcastsController::class,
            'moveDown',
         ])->name('podcasts.moveDown');
      });

   Route::middleware(['op'])
      ->name('op.')
      ->prefix('op')
      ->group(function () {
         Route::resource('operasional', AdminOPController::class);
         Route::resource('cms', AdminOPController::class);
      });

   Route::middleware(['penris'])
      ->name('penris.')
      ->prefix('penris')
      ->group(function () {
         Route::resource('cms', AdminCMSController::class);
         Route::resource('alumni', AdminAliController::class);
         Route::resource('penristek', AdminPenristekController::class);
         Route::resource('saidata', AdminSaiDataController::class);
         Route::resource('arsip', AdminArpController::class);
         Route::resource('beasiswa', AdminBSWController::class);
      });

   // route untuk role ekraf
   Route::middleware(['ekraf'])
      ->name('ekraf.')
      ->prefix('ekraf')
      ->group(function () {
         Route::resource('cms', AdminCMSController::class);
         Route::resource('produk', AdminProdukController::class);
         Route::resource('transaksi', AdminTransaksiController::class);
         Route::resource('carousel', AdminCarouselController::class);
         Route::post('carousel/{carousel}/change-order', [
            AdminCarouselController::class,
            'changeOrder',
         ])->name('carousel.changeOrder');
      });
});

require __DIR__ . '/ui.php';
