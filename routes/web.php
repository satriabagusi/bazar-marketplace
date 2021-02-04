<?php

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

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;

Route::get('/', 'PagesController@index');

Route::get('/merchant/login', 'MerchantController@login')->name('login-merchant');
Route::get('/merchant/logout', 'MerchantController@logout');

Route::get('/pembeli/login', 'PembeliController@login')->name('login-pembeli');
Route::get('/pembeli/logout', 'PembeliController@logout');

Route::get('/superuser/login', 'SuperUserController@login');
Route::get('/admin', 'SuperUserController@login');
Route::get('/superuser/logout', 'SuperUserController@logout');


Route::group(['middleware' => ['merchant']], function () {
    Route::get('/merchant/daftar', 'MerchantController@create');
    Route::post('/merchant/daftar', 'MerchantController@store')->name('register-merchant');
    Route::post('/merchant/login/', 'MerchantController@__login');
    Route::get('/merchant/dashboard', 'MerchantController@dashboard');

    Route::get('/merchant/dashboard/tambah-produk', 'ProdukController@create');
    Route::post('/merchant/dashboard/tambah-produk', 'ProdukController@store');
    Route::get('/merchant/dashboard/ubah-produk/{produk}', 'ProdukController@edit');
    Route::post('/merchant/dashboard/ubah-produk', 'ProdukController@update');
    Route::get('/produk/hapus/{produk}', 'ProdukController@destroy');
    Route::get('/merchant/dashboard/daftar-produk', 'ProdukController@index');

    Route::get('/merchant/dashboard/transaksi', 'TransaksiController@index');
    Route::get('/merchant/dashboard/transaksi/detail/{kode_transaksi}', 'TransaksiController@detailTransaksi');
    Route::get('/merchant/dashboard/transaksi/cari/{transaksi}', 'TransaksiController@search');
    Route::get('/merchant/dashboard/transaksi/konfirmasi/{transaksi}', 'TransaksiController@edit');
    Route::get('/merchant/dashboard/transaksi/hapus/{transaksi}', 'TransaksiController@destroy');


});

Route::group(['middleware' => ['pembeli']], function () {
    Route::get('/pembeli/daftar', 'PembeliController@create');
    Route::post('/pembeli/daftar', 'PembeliController@store')->name('register-pembeli');

    Route::post('/pembeli/login/', 'PembeliController@__login');
    Route::get('/pembeli/dashboard', 'PembeliController@dashboard');

    Route::get('/pembeli/dashboard/profil', 'PembeliController@show');

    Route::post('/transaksi/beli/{id}', 'TransaksiController@store');
    Route::get('/pembeli/dashboard/transaksi', 'TransaksiController@index');
    Route::get('/pembeli/dashboard/transaksi/?status=', 'TransaksiController@index');
    Route::get('/pembeli/dashboard/transaksi/cari/{transaksi}', 'TransaksiController@search');
    Route::get('/pembeli/dashboard/transaksi/konfirmasi/{transaksi}', 'TransaksiController@edit');
    Route::post('/pembeli/dashboard/transaksi/konfirmasi/', 'TransaksiController@update');
    Route::get('/pembeli/dashboard/transaksi/detail/{kode_transaksi}', 'TransaksiController@detailTransaksi');

    Route::get('/pembeli/dashboard/transaksi', 'TransaksiController@index');
    Route::get('/pembeli/dashboard/transaksi/konfirmasi/{transaksi}', 'TransaksiController@edit');
    Route::post('/pembeli/dashboard/transaksi/konfirmasi/', 'TransaksiController@update');
    Route::get('/pembeli/dashboard/transaksi/hapus/{transaksi}', 'TransaksiController@destroy');
    Route::get('/pembeli/dashboard/transaksi/terima/{transaksi}', 'TransaksiController@terimaBarang');

    Route::get('/pembeli/dashboard/poin', 'KuponPembeliController@index');
});

Route::group(['superuser' => ['superuser']], function(){
    Route::post('/superuser/login/', 'SuperUserController@__login');

    Route::get('/superuser/dashboard/daftar-transaksi', 'TransaksiController@index');
    Route::get('/superuser/dashboard/', 'SuperUserController@index');
    Route::post('/superuser/dashboard/transaksi', 'TransaksiController@index');
    Route::get('/superuser/dashboard/transaksi/detail/{kode_transaksi}', 'TransaksiController@detailTransaksi');

    Route::get('/superuser/dashboard/aktivasi/{merchant}', 'SuperUserController@__aktivasi');
    Route::get('/superuser/dashboard/nonaktif/{merchant}', 'SuperUserController@__nonaktif');
    Route::get('/superuser/dashboard/tambah-user', 'SuperUserController@create');
    Route::post('/superuser/dashboard/tambah-user', 'SuperUserController@store');
    Route::get('/superuser/dashboard/daftar-merchant', 'SuperUserController@daftarMerchant');
    Route::get('/superuser/dashboard/hapus-akun/{merchant}', 'SuperUserController@__hapusAkun');
    Route::get('/superuser/dashboard/daftar-pembeli', 'SuperUserController@daftarPembeli');
    Route::get('/superuser/dashboard/hapus-akun-pembeli/{pembeli}', 'SuperUserController@__hapusPembeli');
    Route::get('/superuser/dashboard/transaksi/hapus/{transaksi}', 'TransaksiController@destroy');

    Route::get('/superuser/dashboard/transaksi/konfirmasi/{transaksi}', 'TransaksiController@konfirmasiTransaksi');



});


Route::get('/produk/detail/{produk}', 'ProdukController@show');
Route::get('/produk/filter/kategori/id={produk}', 'PagesController@show');
Route::get('/produk/cari/', 'PagesController@search');
Route::get('/merchant/cari/', 'PagesController@cariMerchant');
Route::get('/merchant/detail/{merchant}', 'MerchantController@show');

Route::get('/merchant/lupa-password', 'MerchantController@lupaPassword');
Route::post('/merchant/lupa-password/', 'MerchantController@sendToken')->name('reset-password');
Route::get('/merchant/reset-password/token={token}', 'MerchantController@passwordReset');
route::post('/merchant/reset/password', 'MerchantController@update')->name('reset');

Route::get('/pembeli/lupa-password', 'PembeliController@lupaPassword');
Route::post('/pembeli/lupa-password/', 'PembeliController@sendToken')->name('reset-password-pembeli');
Route::get('/pembeli/reset-password/token={token}', 'PembeliController@passwordReset');
route::post('/pembeli/reset/password', 'PembeliController@update')->name('reset-pembeli');


Route::get('/superuser/dashboard/transaksi', 'TransaksiController@index');
Route::get('/superuser/dashboard/transaksi/cari/{transaksi}', 'TransaksiController@search');

Route::get('/clear-cache', function() {
    Artisan::call('cache:clear');
    Artisan::call('view:clear');
    Artisan::call('config:clear');
    Artisan::call('route:clear');
    // return what you want
    return redirect('/');
});

