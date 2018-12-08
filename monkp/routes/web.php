<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by These	e RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect('/home');
});

Route::get('/coba', function () {
    return view('inside.inputnilai-mahasiswa');
})->name('mahasiswa');

Route::group(['middleware' => ['auth']], function() {
	Route::get('/home', 'GroupController@index');
	Route::get('/profile','AuthController@getProfile');
	Route::post('/profilex','AuthController@postProfile');
	Route::get('/berita', 'PostController@index');
	Route::get('/post/download/{id}', 'PostController@download');
	Route::get('/pengajuan/destroy/{id}', 'GroupController@destroy');
	Route::group(['middleware' => ['student']], function() {
		Route::get('/pengajuan', 'PengajuanController@create');
		Route::post('/pengajuan', 'PengajuanController@store');
		Route::post('/pengajuan/upload/{id}', 'PengajuanController@upload');
		Route::get('/pengajuan/accept/{id}', 'PengajuanController@accept');
		Route::get('/pengajuan/reject/{id}', 'PengajuanController@reject');
		Route::get('/pengajuan/mentor/{id}', 'GroupController@updateMentor');
		Route::get('/pengajuan/comnt/{id}','PengajuanController@comnt');
		Route::get('/pengajuan/nohp/','PengajuanController@nohp');
	});
	Route::group(['middleware'=>['admin']],function(){
		Route::get('/pengajuan/update/{id}', 'GroupController@update');
		Route::get('/json/groupgrade/{id}', 'GroupController@getGroupWithGrade');
		Route::post('/pengajuan/nilai', 'GroupController@updateGrade');

		Route::get('/pengajuan/comment/{id}','GroupController@comment');

		Route::post('/berita/tambah', 'PostController@store');
		Route::get('/berita/hapus/{id}', 'PostController@destroy');
		Route::post('/berita/edit', 'PostController@update');
		Route::get('/json/getpost/{id}', 'PostController@getpost');

		Route::get('/table', 'AdminController@table');
		Route::get('/table/export', 'AdminController@export');
		Route::get('/table/export/{semester}', 'AdminController@export');
		Route::get('/table/grading/{id}', 'AdminController@grading');
		Route::get('/table/{semester}', 'AdminController@table');
		Route::get('/stats/{semester?}', 'AdminController@stats');
		Route::get('/modal/perusahaan/{id}', 'AdminController@showCorporation');
		Route::get('/modal/perusahaan2/{id}/{smt}', 'AdminController@showCorporation2');

		Route::get('/periode', 'AdminController@getPeriode');
		Route::post('/periode', 'AdminController@postPeriode');

		Route::get('/users', 'UserController@create');
		Route::post('/users/mahasiswa', 'UserController@student');
		Route::post('/users/dosen', 'UserController@lecturer');
		Route::post('/users/reset', 'UserController@reset');
	});
});
Route::post('/registerx','AuthController@postRegister');
Route::post('/loginx','AuthController@postLogin');
Auth::routes();

