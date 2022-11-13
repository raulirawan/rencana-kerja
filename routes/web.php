<?php

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

Route::get('/', function () {
    return view('auth.login');
});
Route::prefix('admin')
    ->middleware(['auth', 'admin'])
    ->group(function () {
        Route::get('dashboard', 'Admin\DashboardController@index')->name('admin.dashboard.index');

        // CRUD User
        Route::get('user', 'Admin\UserController@index')->name('admin.user.index');
        Route::post('user/create', 'Admin\UserController@store')->name('admin.user.store');
        Route::post('user/update/{id}', 'Admin\UserController@update')->name('admin.user.update');
        Route::post('user/delete/{id}', 'Admin\UserController@delete')->name('admin.user.delete');

        Route::get('skpd', 'Admin\SkpdController@index')->name('admin.skpd.index');
        Route::post('skpd/create', 'Admin\SkpdController@store')->name('admin.skpd.store');
        Route::post('skpd/update/{id}', 'Admin\SkpdController@update')->name('admin.skpd.update');
        Route::post('skpd/delete/{id}', 'Admin\SkpdController@delete')->name('admin.skpd.delete');

        Route::get('sasaran-strategis', 'Admin\SasaranStrategisController@index')->name('admin.sasaran-strategis.index');
        Route::post('sasaran-strategis/create', 'Admin\SasaranStrategisController@store')->name('admin.sasaran-strategis.store');
        Route::post('sasaran-strategis/update/{id}', 'Admin\SasaranStrategisController@update')->name('admin.sasaran-strategis.update');
        Route::post('sasaran-strategis/delete/{id}', 'Admin\SasaranStrategisController@delete')->name('admin.sasaran-strategis.delete');

        Route::get('monitor/', 'Admin\MonitorController@index')->name('admin.monitor.index');
        Route::post('monitor/create', 'Admin\MonitorController@store')->name('admin.monitor.store');
        Route::post('monitor/update/{id}', 'Admin\MonitorController@update')->name('admin.monitor.update');
        Route::post('monitor/delete/{id}', 'Admin\MonitorController@delete')->name('admin.monitor.delete');
        Route::get('monitor/{monitor_id}', 'Admin\MonitorController@dashboard')->name('admin.monitor.dashboard');


        Route::get('kegiatan/{monitor_id}', 'Admin\KegiatanController@index')->name('admin.kegiatan.index');
        Route::post('kegiatan/create', 'Admin\KegiatanController@store')->name('admin.kegiatan.store');
        Route::post('kegiatan/update/{id}', 'Admin\KegiatanController@update')->name('admin.kegiatan.update');
        Route::post('kegiatan/delete/{id}', 'Admin\KegiatanController@delete')->name('admin.kegiatan.delete');

        Route::get('renaksi/{kegiatan_id}', 'Admin\RenaksiController@index')->name('admin.renaksi.index');
        Route::post('renaksi/create', 'Admin\RenaksiController@store')->name('admin.renaksi.store');
        Route::post('renaksi/update/{id}', 'Admin\RenaksiController@update')->name('admin.renaksi.update');
        Route::post('renaksi/delete/{id}', 'Admin\RenaksiController@delete')->name('admin.renaksi.delete');
        Route::get('/renaksi/detail/{renaksi_id}', 'Admin\RenaksiController@detail')->name('admin.renaksi.detail');


        Route::post('/renaksi/create/kriteria/', 'Admin\RenaksiController@storeKriteria')->name('admin.renaksi.store.kriteria');

        Route::get('/renaksi/ukuran/detail/{ukuran_id}', 'Admin\RenaksiController@detailUkuran')->name('admin.renaksi.ukuran.detail');
        Route::post('/renaksi/ukuran/update', 'Admin\RenaksiController@updateUkuran')->name('admin.renaksi.ukuran.update');
        Route::get('renaksi/{kegiatan_id}/{status}/{periode}', 'Admin\RenaksiController@getRenaksiStatus')->name('admin.renaksi.status.index');
    });


Route::middleware(['auth'])->group(function () {
    Route::get('dashboard', 'DashboardController@index')->name('dashboard.index');

    Route::get('monitor/', 'MonitorController@index')->name('monitor.index');
    Route::get('kegiatan/{monitor_id}', 'KegiatanController@index')->name('kegiatan.index');
    Route::get('renaksi/{kegiatan_id}', 'RenaksiController@index')->name('renaksi.index');
    Route::get('/renaksi/detail/{renaksi_id}', 'RenaksiController@detail')->name('renaksi.detail');

    Route::get('/renaksi/ukuran/detail/{ukuran_id}', 'RenaksiController@detailUkuran')->name('renaksi.ukuran.detail');
    Route::post('/renaksi/ukuran/update', 'RenaksiController@updateUkuran')->name('renaksi.ukuran.update');

    Route::get('renaksi/file-ukuran/delete/{id}/{key}', 'RenaksiController@deleteFile')->name('ukuran.delete.file');
});

Auth::routes();
