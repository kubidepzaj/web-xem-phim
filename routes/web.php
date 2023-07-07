<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\HomeController;

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\EpisodeController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\InfoController;
use App\Http\Controllers\LinkController;
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

Route::get('/', [IndexController::class, 'home'])->name('homepage');
Route::get('/danh-muc/{slug}', [IndexController::class, 'category'])->name('category');
Route::get('/the-loai/{slug}', [IndexController::class, 'genre'])->name('genre');
Route::get('/quoc-gia/{slug}', [IndexController::class, 'country'])->name('country');
Route::get('/phim/{slug}', [IndexController::class, 'movie'])->name('movie');
Route::get('/xem-phim/{slug}/{tap}/{server_active}', [IndexController::class, 'watch']);
Route::get('/tap-phim', [IndexController::class, 'episode'])->name('tap-phim');
Route::get('/year/{year}', [IndexController::class, 'year']);
Route::get('/tags/{tags}', [IndexController::class, 'tags']);
Route::get('/tim-kiem', [IndexController::class, 'search'])->name('search');
Route::get('/loc-phim', [IndexController::class, 'loc_phim'])->name('filter');


Route::get('/dang-ky', [IndexController::class, 'dang_ky'])->name('dang-ky');
Route::get('/dang-nhap', [IndexController::class, 'dang_nhap'])->name('dang-nhap');
Route::get('/dang-xuat', [IndexController::class, 'dang_xuat'])->name('dang-xuat');

Route::post('/bookmark', [IndexController::class, 'bookmark'])->name('bookmark');
Route::post('/bookmark/delete/{bookmarkId}', [IndexController::class, 'delete_bookmark']);
Route::post('/bookmark/delete-all', [IndexController::class, 'delete_all_bookmark']);



Route::post('/register-publisher', [IndexController::class, 'register_publisher'])->name('register-publisher');
Route::post('/login-publisher', [IndexController::class, 'login_publisher'])->name('login-publisher');






Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::post('resorting_category', [CategoryController::class, 'resorting_category'])->name('resorting_category');

Route::resource('category', CategoryController::class);
Route::resource('genre', GenreController::class);
Route::resource('movie', MovieController::class);
Route::resource('episode', EpisodeController::class);
Route::resource('country', CountryController::class);
//thong tin website
Route::resource('info', InfoController::class);
Route::resource('link', LinkController::class);


//tu phim chon ra so tap
Route::get('select-movie', [EpisodeController::class,'select_movie'])->name('select-movie');

//them tap phim tu trang phim
Route::get('add-episode/{id}', [EpisodeController::class,'add_episode'])->name('add-episode');


Route::get('/update-movie-year', [MovieController::class,'update_movie_year']);
Route::get('/update-topview', [MovieController::class,'update_topview']);

//sidebar
Route::get('/filter-topview', [MovieController::class,'filter_topview']);
Route::get('/filter-topview-default', [MovieController::class,'filter_topview_default']);

