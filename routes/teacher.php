<?php

use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use App\Http\Controllers\Teacher\ClasseController;
use App\Http\Controllers\Teacher\SubjectController;
use App\Http\Controllers\Teacher\AttendanceController;
use App\Http\Controllers\Teacher\MaterialController;


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
        'prefix' => LaravelLocalization::setLocale() . '/teacher',
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'auth:teacher'],
        'as' => 'teacher.'
    ], function () {
    Route::get('/', function () {
        return view('Teacher.dashboard');
    })->name('dashboard');
    Route::get('classes', [ClasseController::class, 'index'])->name('classes.index');
    Route::get('subjects', [SubjectController::class, 'index'])->name('subjects.index');
    Route::get('attendance', [AttendanceController::class, 'index'])->name('attendance.index');
    Route::get('attendance/absence/{class_id}', [AttendanceController::class, 'showAbsence'])->name('attendance.showAbsence');
    Route::post('attendance/absence/{class_id}', [AttendanceController::class, 'absence'])->name('attendance.absence');
    Route::resource('materials',MaterialController::class);
    Route::get('getClasses/{id}',[MaterialController::class,'getClass'])->name('getclass');
    Route::get('get-subject/{class_id}',[MaterialController::class,'getSubject'])->name('getSubject');
});
