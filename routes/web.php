<?php

use App\Http\Controllers;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PagesController;
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

// Auth::routes();

/**
 * Routes untuk authentication
 */
Route::get('/login', 'AuthController@index')->name('login');
Route::post('/login', 'AuthController@authenticate')->name('login.post');
Route::post('/logout', 'AuthController@logout')->middleware('auth')->name('logout');

/**
 * Reoute ke app utama Alumni dan Pengunjung
 */
Route::get('/', 'PagesController@index')->name('home');
Route::get('/about', 'PagesController@about')->name('bkk.about');

Route::prefix('alumni')->middleware('auth')->group(function() {
    Route::get('/list', 'PagesController@alumni')->name('bkk.alumni');
    Route::get('/detail/{id}', 'PagesController@alumniShow')->name('bkk.alumni.detail');
});

Route::prefix('loker')->group(function() {
    Route::get('/list', 'PagesController@jobvacancy')->name('bkk.loker');
    Route::get('/detail/{id}', 'PagesController@detailvacany')->name('bkk.loker.detail');
    Route::get('/apply-job/{id}', 'Alumni\LokerController@apply')->middleware('is_alumni')->name('alumni.aplly');;
});

Route::prefix('mitra')->group(function() {
    Route::get('/list', 'PagesController@mitra')->name('bkk.mitra');
    Route::get('/detail/{id}', 'PagesController@mitradetail')->name('bkk.mitra.detail');
});

Route::prefix('info')->group(function() {
    Route::get('/list', 'PagesController@information')->name('bkk.informasi');
    Route::get('/detail/{id}', 'PagesController@informationdetail')->name('bkk.informtiona.detail');
});

// /**
//  * Route akses is_alumni
//  */
// Route::get('/alumni/detail/{id}', [PagesController::class, 'show'])->middleware('is_alumni')->name('alumni.detail');
// Route::get('/job-vacancy/apply/{id}', [PagesController::class, 'apply_job'])->middleware('is_alumni')->name('loker.lamar');

/**
 * Route Dashboard Admin
 */
Route::prefix('ad')->middleware('is_admin')->namespace('\App\Http\Controllers\Admin')->group(function() {
    Route::get('/main', 'MainController@index')->name('admin.home');
    Route::get('/profile', 'MainController@profile')->name('admin.profile');
    Route::get('/account', 'MainController@account')->name('admin.account');
    Route::get('/notification', 'MainController@notification')->name('admin.notif');
    Route::get('/notification/detail/{id}', 'MainController@notifShow')->name('admin.notif.detail');

    /**
     * Route Dashboard Admin Alumni
     */
    Route::prefix('al')->group(function() {
        Route::get('/penelusuran', 'AlumniController@index')->name('admin.alumni');
        Route::get('/list', 'AlumniController@list')->name('admin.alumni.list');
        Route::get('/detail/{id}', 'AlumniController@show')->name('admin.alumni.detail');
        Route::get('/create', 'AlumniController@create')->name('admin.alumni.create');
        Route::post('/store', 'AlumniController@store')->name('admin.alumni.store');
        Route::get('/edit/{id}', 'AlumniController@edit')->name('admin.alumni.edit');
        Route::post('/update/{id}', 'AlumniController@update')->name('admin.alumni.update');
        Route::post('/delete/{id}', 'AlumniController@destroy')->name('admin.alumni.delete');

        Route::get('/penelusuran/{id}', 'AlumniController@index')->name('admin.penelusuran');
        Route::get('/penelusuran/jurusan/{nama}', 'AlumniController@searchJurusan')->name('admin.penelusuran.jurusan');
    });

    /**
     * Route Dashboard Admin User
     */
    Route::prefix('us')->group(function() {
        Route::get('/main', 'UserController@index')->name('admin.users');
        Route::get('detail/{id}', 'UserController@show')->name('admin.users.detail');
        Route::get('/edit/{id}', 'UserController@edit')->name('admin.users.edit');
        Route::post('/update/{id}', 'UserController@update')->name('admin.users.update');
        Route::post('/delete/{id}', 'UserController@destroy')->name('admin.users.delete');
    });

    /**
     * Route Dashboard Admin Information
     */
    Route::prefix('nw')->group(function() {
        Route::get('/main', 'InformationController@index')->name('admin.news');
        Route::get('/detail/{id}', 'InformationController@show')->name('admin.news.detail');
        Route::get('/create', 'InformationController@create')->name('admin.news.create');
        Route::post('/store', 'InformationController@store')->name('admin.news.store');
        Route::get('/edit/{id}', 'InformationController@edit')->name('admin.news.edit');
        Route::post('/update/{id}', 'InformationController@update')->name('admin.news.update');
        Route::post('/delete/{id}', 'InformationController@destroy')->name('admin.news.delete');
    });

    /**
     * Route Dashboard Admin Mitra
     */
    Route::prefix('mt')->group(function() {
        Route::get('/list', 'MitraController@index')->name('admin.mitra');
        Route::get('/detail/{id}', 'MitraController@show')->name('admin.mitra.detail');
        Route::get('/create', 'MitraController@create')->name('admin.mitra.create');
        Route::post('/store', 'MitraController@store')->name('admin.mitra.store');
        Route::get('/edit/{id}', 'MitraController@edit')->name('admin.mitra.edit');
        Route::post('/update/{id}', 'MitraController@update')->name('admin.mitra.update');
        Route::post('/delete/{id}', 'MitraController@destroy')->name('admin.mitra.delete');
    });

    /**
     * Route Dashboard Admin Loker
     */
    Route::prefix('lk')->group(function() {
        Route::get('/main', 'LokerController@index')->name('admin.loker');
        Route::get('/detail/{id}', 'LokerController@show')->name('admin.loker.detail');
        Route::get('/edit/{id}', 'LokerController@edit')->name('admin.loker.edit');
        Route::post('/update/{id}', 'LokerController@update')->name('admin.loker.update');
    });

});

/**
 * Route Dashboard Mitra
 */
Route::prefix('mt')->middleware('is_mitra')->group(function () {
    Route::get('/main', 'mitra\MainController@main')->name('mitra.home');
    Route::get('/notif', 'mitra\MainController@notif');
    Route::get('/profil', 'mitra\MainController@profil')->name('mitra.profile');
    Route::get('/profil/ubah/{id}', 'mitra\MainController@prUbah');
    Route::post('/profil/ubahPost', 'mitra\MainController@prUbahPost');

    Route::get('/kantor/tambah', 'mitra\MainController@kantorAdd');
    Route::post('/kantor/post', 'mitra\MainController@kantorPost');
    Route::get('/kantor/ubah/{id}', 'mitra\MainController@kantorEdit');
    Route::post('/kantor/editPost', 'mitra\MainController@kantorEditPost');
    Route::post('/kantor/hapus/{id}', 'mitra\MainController@kantorDelete');

    Route::prefix('lk')->group(function () {
        Route::get('/main', 'mitra\LokerController@main')->name('mitra.loker');
        Route::get('/detail/{id}', 'mitra\LokerController@detail');
        Route::get('/tambah', 'mitra\LokerController@tambah')->name('tambah-mitra');
        Route::post('/tambahpost', 'mitra\LokerController@store');
        Route::get('/ubah/{id}', 'mitra\LokerController@ubah');
        Route::post('/ubah/post', 'mitra\LokerController@ubahStore');
        Route::post('/hapus/{id}', 'mitra\LokerController@hapus')->name('loker.delete');

        Route::get('/pelamar/{id}', 'mitra\LokerController@pelamar')->name('mitra.pelamar');
        Route::get('/pelamar/print/{id}', 'mitra\LokerController@generatePelamar');

        Route::get('/rekomend/{id}', 'mitra\LokerController@rekomend')->name('mitra.rekomend');
        Route::post('/rekomend/post', 'mitra\LokerController@rekomendAdd');

        Route::get('/tahap/{id}', 'mitra\LokerController@tahap')->name('mitra.tahap');
        // MENAMBAH TAHAPAN BARU
        Route::post('/tahap/post', 'mitra\LokerController@tahapAdd');
        // HALAMAN TAHAP SELEKSI
        Route::get('/tahap/detail/{id}', 'mitra\LokerController@tahapSeleksi')->name('mitra.tahap.detail');
        // HALAMAN UNTUK MENAMBAH ALUMNI YANG DISELEKSI
        Route::post('/tahap/seleksi/{id}', 'mitra\LokerController@alumniSeleksi');
    });

    Route::prefix('re')->group(function () {
        Route::get('/main', 'mitra\RekomendController@main')->name('mitra.rekomendasi');
        Route::post('/tambah', 'mitra\RekomendController@add');
    });
});

Route::prefix('al')->middleware('is_alumni')->namespace('\App\Http\Controllers\Alumni')->group(function() {
    Route::get('/main', 'MainController@index')->name('alumni.home');
    Route::get('/profile', 'MainController@profile')->name('alumni.profile');
    Route::get('/account', 'MainController@account')->name('alumni.rekomendasi');
    Route::get('/notification', 'MainController@notification')->name('alumni.notif');
    Route::get('/notification/detail/{id}', 'MainController@notifShow')->name('alumni.notif.detail');

    Route::prefix('lk')->group(function() {
        Route::get('/main', 'LokerController@index')->name('mitra.loker');
        Route::get('/detail/{id}', 'LokerController@show')->name('mitra.loker.detail');
        Route::get('/create', 'LokerController@create')->name('mitra.loker.create');
        Route::post('/store', 'LokerController@store')->name('mitra.loker.store');
        Route::get('/edit/{id}', 'LokerController@edit')->name('mitra.loker.edit');
        Route::post('/update/{id}', 'LokerController@update')->name('mitra.loker.update');
        Route::post('/delete/{id}', 'LokerController@destroy')->name('mitra.loker.delete');
    });

    Route::prefix('re')->group(function () {
        Route::get('/main', 'RekomendController@main')->name('mitra.rekomendasi');
        Route::get('/create', 'RekomendController@create')->name('mitra.rekomendasi.create');
        Route::post('/store', 'RekomendController@store')->name('mitra.rekomendasi.store');
    });
});