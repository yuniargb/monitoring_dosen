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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/login', 'AuthController@login')->name('login');
Route::get('/logout', 'AuthController@logout')->name('logout');
Route::get('/grafik', 'DashboardController@grafik');
Route::post('/loginpost', 'AuthController@loginpost');
Route::group(['middleware' => ['auth']], function () {
Route::get('/', 'DashboardController@dashboard');
});
Route::group(['prefix' => 'admin','middleware' => ['auth','checkRole:1']], function () {
    Route::get('/iklan', 'AdminController@indexIklan');
    Route::group(['prefix' => 'iklan','middleware' => ['auth','checkRole:1']], function () {
        Route::put('/update/{id}', 'AdminController@updateIklan'); 
    });
    // crud umum
    Route::get('/prodi', 'ProdiController@index');
    Route::group(['prefix' => 'prodi','middleware' => ['auth','checkRole:1']], function () {
        Route::get('/form', 'ProdiController@create');
        Route::get('/form/{id}', 'ProdiController@edit');
        Route::post('/add', 'ProdiController@store');
        Route::put('/update/{id}', 'ProdiController@update'); 
    });
    Route::get('/fakultas', 'FakultasController@index');
    Route::group(['prefix' => 'fakultas','middleware' => ['auth','checkRole:1']], function () {
        Route::get('/form', 'FakultasController@create');
        Route::get('/form/{id}', 'FakultasController@edit');
        Route::post('/add', 'FakultasController@store');
        Route::put('/update/{id}', 'FakultasController@update'); 
    });
    Route::get('/dosen', 'DosenController@index');
    Route::group(['prefix' => 'dosen','middleware' => ['auth','checkRole:1']], function () {
        Route::get('/form', 'DosenController@create');
        Route::get('/form/{id}', 'DosenController@edit');
        Route::post('/add', 'DosenController@store');
        Route::put('/update/{id}', 'DosenController@update'); 
    });
    Route::get('/admin', 'AdminController@index');
    Route::group(['prefix' => 'admin','middleware' => ['auth','checkRole:1']], function () {
        Route::get('/form', 'AdminController@create');
        Route::get('/form/{id}', 'AdminController@edit');
        Route::post('/add', 'AdminController@store');
        Route::put('/update/{id}', 'AdminController@update'); 
    });
    Route::get('/staf', 'StafController@index');
    Route::group(['prefix' => 'staf','middleware' => ['auth','checkRole:1']], function () {
        Route::get('/form', 'StafController@create');
        Route::get('/form/{id}', 'StafController@edit');
        Route::post('/add', 'StafController@store');
        Route::put('/update/{id}', 'StafController@update'); 
    });
    Route::get('/baak', 'BAAKController@index');
    Route::group(['prefix' => 'baak','middleware' => ['auth','checkRole:1']], function () {
        Route::get('/form', 'BAAKController@create');
        Route::get('/form/{id}', 'BAAKController@edit');
        Route::post('/add', 'BAAKController@store');
        Route::put('/update/{id}', 'BAAKController@update'); 
    });
    
});
Route::group(['middleware' => ['auth','checkRole:1|2|3|4|5|6|7']], function () {
    Route::get('/pengajuan', 'PengajuanController@index');
    Route::group(['prefix' => 'pengajuan','middleware' => ['auth','checkRole:1|2']], function () {
        Route::get('/dashboard', 'PengajuanController@dashboard');
    });
    Route::group(['prefix' => 'pengajuan','middleware' => ['auth','checkRole:1|2|3|4|5|6|7']], function () {
        Route::get('/detailfile/{jenis}/{id}', 'PengajuanController@detail');
        Route::get('/download/{filenames}', 'PengajuanController@downloadFile');
    });
    Route::group(['prefix' => 'pengajuan','middleware' => ['auth','checkRole:1|2|4']], function () {
        Route::get('/dosen', 'DosenController@index');
        
        Route::get('/konfirmasi', 'PengajuanController@konfirmasiView');
        Route::get('/ditolak', 'PengajuanController@tolakView');
        Route::get('/ditagguhkan', 'PengajuanController@ditagguhkanView');
        Route::get('/form', 'PengajuanController@create');
        Route::get('/form/{id}', 'PengajuanController@edit');
        Route::get('/form/tolak/{id}', 'PengajuanController@tolakForm');
        Route::get('/form/konfirmasi/{id}', 'PengajuanController@konfirmasiForm');
        Route::post('/add', 'PengajuanController@store');
        Route::put('/update/{id}', 'PengajuanController@update'); 
        Route::put('/tolak/{id}', 'PengajuanController@updateTolak');
        Route::put('/konfirmasi/{id}', 'PengajuanController@updateKonfirmasi');
    });
});
Route::group(['middleware' => ['auth','checkRole:1|2|3|4|5|6|7']], function () {
    Route::get('/review', 'ReviewController@index');
    Route::get('/laporan', 'LaporanController@pengajuan');
    Route::post('/cetaklaporanpengajuan', 'LaporanController@cetakPengajuan');
    Route::group(['prefix' => 'review'], function () {
    Route::get('/detailfile/{id}', 'ReviewController@detail');
    });
    Route::group(['prefix' => 'review','middleware' => ['auth','checkRole:1|3|5|6|7']], function () {
        Route::get('/dashboard', 'ReviewController@dashboard');
    });
    Route::group(['prefix' => 'review','middleware' => ['auth','checkRole:1|2|3|5|6|7']], function () {
        Route::put('/konfirmasi/{id}', 'ReviewController@updateKonfirmasi');
        Route::get('/form/tolak/{id}', 'ReviewController@tolakForm');
        Route::get('/form/konfirmasi/{id}', 'ReviewController@konfirmasiForm');
        Route::put('/tolak/{id}', 'ReviewController@updateTolak');
        Route::get('/konfirmasi', 'ReviewController@konfirmasiView');
        Route::get('/ditolak', 'ReviewController@tolakView');
        Route::get('/ditagguhkan', 'ReviewController@ditagguhkanView');
        Route::get('/form/{id}', 'ReviewController@edit');
        Route::post('/add', 'ReviewController@store');
        Route::put('/update/{id}', 'ReviewController@update'); 
        
        Route::get('/dosen', 'DosenController@index');
        
    });
});







