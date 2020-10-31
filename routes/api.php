<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::delete('/admin/fakultas/delete/{id}', 'FakultasController@destroy');
Route::delete('/admin/prodi/delete/{id}', 'ProdiController@destroy');
Route::delete('/admin/dosen/delete/{id}', 'DosenController@destroy');
Route::delete('/admin/admin/delete/{id}', 'AdminController@destroy');
Route::delete('/admin/baak/delete/{id}', 'BAAKController@destroy');
Route::delete('/admin/staf/delete/{id}', 'StafController@destroy');
Route::delete('/pengajuan/delete/{id}', 'PengajuanController@destroy');
Route::delete('/pengajuan/dokumen/delete/{id}', 'PengajuanController@destroyDokumen');
Route::delete('/review/dokumen/delete/{id}', 'ReviewController@destroyDokumen');
Route::put('/pengajuan/confirm/{id}', 'PengajuanController@confirm');
Route::put('/review/konfirmasi/{id}', 'ReviewController@updateKonfirmasi');

