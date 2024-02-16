<?php

use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use App\Http\Controllers\Admin\RegisterController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\NewController;
use App\Http\Controllers\Admin\GuidelineController;
use App\Http\Controllers\Admin\VisionController;
use App\Http\Controllers\Admin\AnnouncementController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::group(
    [
        'prefix' => LaravelLocalization::setLocale() . '/admin',
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'auth:admin'],
        'as' => 'admin.'
    ], function () {
    Route::get('/', function () {
        return view('Admin.dashboard');
    })->name('dashboard');
    Route::resource('registers', RegisterController::class);
    //News
    Route::resource('news', NewController::class);
    Route::resource('posts', PostController::class);
    Route::resource('guidelines', GuidelineController::class);
    Route::resource('visions', VisionController::class);
    Route::resource('announcements', AnnouncementController::class);


});
