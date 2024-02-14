<?php

use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

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
        'prefix' =>LaravelLocalization::setLocale().'/teacher',
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath','auth:teacher' ],
        'as'=>'teacher.'
    ], function(){
    Route::get('/', function () {
        return view('Teacher.dashboard');
    })->name('dashboard');
});
