<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\backend\BackendController;
use App\Http\Controllers\backend\BannerController;
use App\Http\Controllers\Frontend\FrontendController;


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

Route::get('/', [FrontendController:: class, 'index'])->name('frontend.home');

Auth::routes();

Route::name('backend.')->group(function(){
    Route::get('/dashboard', [BackendController::class, 'index'])->name('home');

    Route::resource('/banner', BannerController::class)->except(['show']);
    Route::get('/banner/status/{banner}', [BannerController::class, 'status'])->name('banner.status');
    Route::get('/banner/restore/{id}', [BannerController::class, 'restore'])->name('banner.restore');
    Route::get('/banner/delete/forever/{id}', [BannerController::class, 'deleteforever'])->name('banner.deleteforever');
});


