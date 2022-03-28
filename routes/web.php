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

Route::get('/', function () {
    return redirect('/login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/jenis','JenisController@index');
Route::post('/jenis/store','JenisController@store');
Route::post('/jenis/update','JenisController@update');
Route::get('/jenis/edit/{id_jenis}','JenisController@edit');
Route::get('/jenis/delete/{id_jenis}','JenisController@delete');


Route::get('/admin','UserController@index');
Route::post('/admin/store','UserController@store');
Route::post('/admin/update','UserController@update');
Route::get('/admin/edit/{id}','UserController@edit');

Route::get('/kasir','UserController@index2');
Route::post('/kasir/store','UserController@store2');
Route::post('/kasir/update','UserController@update2');
Route::get('/kasir/edit/{id}','UserController@edit2');

Route::get('/owner','UserController@index3');
Route::post('/owner/store','UserController@store3');
Route::post('/owner/update','UserController@update3');
Route::get('/owner/edit/{id}','UserController@edit3');


Route::get('/member','MemberController@index');
Route::post('/member/store','MemberController@store');
Route::post('/member/update','MemberController@update');
Route::get('/member/edit/{id_member}','MemberController@edit');
Route::get('/member/delete/{id_member}','MemberController@delete');

Route::get('/outlet','OutletController@index');
Route::post('/outlet/store','OutletController@store');
Route::post('/outlet/update','OutletController@update');
Route::get('/outlet/edit/{id_outlet}','OutletController@edit');
Route::get('/outlet/delete/{id_outlet}','OutletController@delete');

Route::get('/paket','PaketController@index');
Route::post('/paket/store','PaketController@store');
Route::post('/paket/update','PaketController@update');
Route::get('/paket/edit/{id_paket}','PaketController@edit');
Route::get('/paket/delete/{id_paket}','PaketController@delete');

Route::get('/transaksi','TransaksiController@index');
Route::get('/transaksi/tambah','TransaksiController@tambah');
Route::post('/transaksi/store','TransaksiController@store');

Route::get('/transaksi/pakaian1/{id_transaksi}','TransaksiController@pakaian1');
Route::get('/transaksi/pakaian2/{id_transaksi}','TransaksiController@pakaian2');
Route::get('/transaksi/pakaian3/{id_transaksi}','TransaksiController@pakaian3');


Route::get('/transaksi/bayar1/{id_transaksi}','TransaksiController@bayar1');

Route::get('/ambil','TransaksiController@ambil');
Route::get('/ambil2','TransaksiController@ambil2');


Route::post('/masuk/sementara','TransaksiController@store');
Route::post('/masuk/semua','TransaksiController@storesemua');
Route::get('/cetak/{id_transaksi}','TransaksiController@cetak');
Route::get('/transaksi/show/{id_transaksi}','TransaksiController@show');
Route::get('/laporan/show/{id_transaksi}','TransaksiController@show');

Route::get('/laporan','LaporanController@index');
Route::post('/laporan_masuk','LaporanController@index');

Route::get('change-password', 'ChangePasswordController@index');
Route::post('change-password', 'ChangePasswordController@store')->name('change.password');

Route::get('/laporan/export_excel', 'LaporanController@export_excel');
Route::get('/laporan/export_pdf', 'LaporanController@export_pdf');

