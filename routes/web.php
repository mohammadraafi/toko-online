<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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



Auth::routes();

//
Route::get('/', 'HomeController@index')->name('home');

// Kategori
Route::get('/categories', 'CategoryController@index')->name('categories');
Route::get('/categories/{id}', 'CategoryController@detail')->name('categories-detail');

// Detail Produk
Route::get('/details/{id}', 'DetailController@index')->name('details');
Route::post('/details/{id}', 'DetailController@add')->name('details-add');

//
Route::post('/checkout/callback', 'CheckoutController@callback')->name('midtrans-callback');

// Auth
Route::get('/register/success', 'Auth\RegisterController@success')->name('register-success');
Route::post('login', 'Auth\LoginController@login')->name('login.store');



Route::group(['middleware' => ['auth']], function () {
    // Keranjang
    Route::get('/cart', 'CartController@index')->name('cart');
    Route::post('/cart-update', 'CartController@update')->name('cart-update');
    Route::post('/cart', 'CartController@submit');
    Route::get('/province/{id}/cities', 'CartController@getCities');
    Route::delete('/cart/{id}', 'CartController@delete')->name('cart-delete');

    // Alamat customer
    // Route::get('/alamat-customer', 'AlamatController@index')->name('alamat-customer.index');
    Route::get('/alamat-customer/create', 'AlamatController@create')->name('alamat-customer.create');
    Route::get('/getcity/{id}', 'AlamatController@getCity')->name('alamat-customer.getCity');
    Route::post('/simpan-alamat-customer', 'AlamatController@store')->name('alamat-customer.store');
    Route::get('/alamat/edit/{id}', 'AlamatController@edit')->name('alamat-customer.edit');
    Route::post('/alamat/update/{id}', 'AlamatController@update')->name('alamat-customer.update');

    // Checkout
    Route::get('/checkout', 'CheckoutController@index')->name('checkout.index');
    Route::post('/checkout-store', 'CheckoutController@process')->name('checkout');

    //transaksi pelanggan
    Route::get('/history-transactions', 'TransactionsController@index')->name('history-transaction.index');
    Route::get('/history-transactions/detail/{id}', 'TransactionsController@show')->name('history-transaction.show');
    Route::post('/history-transactions/detail/{id}', 'TransactionsController@recieved')->name('history-transaction.recieved');

    // Dashboard
    Route::get('/dashboard/settings', 'DashboardSettingController@store')->name('dashboard-settings-store');
    Route::get('/alamat-customer', 'DashboardSettingController@account')->name('dashboard-settings-account');
    Route::get('/getcity/{id}', 'DashboardSettingController@getCity')->name('dashboard-settings.getCity');
    Route::post('/dashboard/account/{redirect}', 'DashboardSettingController@update')->name('dashboard-settings-redirect');
    Route::post('/dashboard/account', 'DashboardSettingController@updatePhoto')->name('dashboard-settings-photo');

    // review
    Route::get('/ulasan-produk', 'ReviewController@index')->name('review.index');
    Route::post('/review-post', 'ReviewController@store')->name('review.store');

    // kritik
    Route::get('/kritik-customer', 'Admin\KritikController@customer')->name('kritik-customer.index');
    Route::get('/kritik-create', 'Admin\KritikController@create')->name('kritik.create');
    Route::post('/kritik-post', 'Admin\KritikController@store')->name('kritik.store');
    Route::get('/detail-penilaian/{id}',  'Admin\KritikController@show')->name('kritik.show');

    // pengaduan
    Route::get('/pengaduan-pelanggan', 'Admin\PengaduanController@pelanggan')->name('pengaduan.pelanggan.index');
    Route::get('/tambah-pengaduan', 'Admin\PengaduanController@create')->name('pengaduan.create');
    Route::post('/tambah-pengaduan', 'Admin\PengaduanController@store')->name('pengaduan.store');
    Route::get('/detail-pengaduan-pelanggan/{id}', 'Admin\PengaduanController@detail_pengaduan')->name('pengaduan.pelanggan.detail');
});

Route::prefix('admin')
    ->namespace('Admin')
    ->middleware(['auth', 'admin'])
    ->group(function () {
        Route::get('/', 'DashboardController@index')->name('admin-dashboard');
        Route::resource('category', 'CategoryController');
        Route::resource('user', 'UserController');
        Route::resource('product', 'ProductController');
        Route::resource('product-gallery', 'ProductGalleryController');

        // Discount
        Route::get('/product-discount', 'ProductController@discount')->name('product-discount.index');
        Route::get('/add-discount/{id}', 'ProductController@add_discount')->name('product-discount.add');
        Route::put('/store-discount/{id}', 'ProductController@store_discount')->name('product-discount.store');
        Route::post('/destroy-discount/{id}', 'ProductController@destroy_discount')->name('product-discount.destroy');
        Route::get('/edit-discount/{id}', 'ProductController@edit_discount')->name('product-discount.edit');
        Route::put('/update-discount/{id}', 'ProductController@update_discount')->name('product-discount.update');

        // Alamat
        Route::get('/alamat-toko', 'AlamatTokoController@index')->name('alamat-toko.index');
        Route::get('/getcity/{id}', 'AlamatTokoController@getCity')->name('alamat-toko.getCity');
        Route::post('/simpan-alamat-toko', 'AlamatTokoController@store')->name('alamat-toko.store');
        Route::get('/alamat-toko/edit/{id}', 'AlamatTokoController@edit')->name('alamat-toko.edit');
        Route::post('/alamat-toko/update/{id}', 'AlamatTokoController@update')->name('alamat-toko.update');

        // Transaksi
        Route::get('/transactions', 'DashboardTransactionController@index')->name('dashboard-transactions');
        Route::get('/transactions/{id}', 'DashboardTransactionController@details')->name('dashboard-transaction-details');
        Route::post('/transactions/{id}', 'DashboardTransactionController@update')->name('dashboard-transaction-update');

        // Pengaduan
        Route::get('/pengaduan', 'PengaduanController@index')->name('pengaduan.index');
        Route::get('detail-pengaduan/{id}', 'PengaduanController@show')->name('pengaduan.show');

        // Tanggapan Pengaduan
        Route::get('/tambah-tanggapan/{id}', 'TanggapanController@show')->name('tanggapan.show');
        Route::post('/tanggpan-store', 'TanggapanController@store')->name('tanggapan.store');

        // Kritik
        Route::get('/kritik', 'KritikController@index')->name('kritik.index');

        // Tanggapan kritik
        Route::post('/responses-post', 'ResponsesController@store')->name('responses.store');
        Route::get('/responses-add/{id}', 'ResponsesController@show')->name('responses.add');
    });
