<?php

use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use App\Http\Controllers\Admin\RegisterController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\NewController;
use App\Http\Controllers\Admin\GuidelineController;
use App\Http\Controllers\Admin\VisionController;
use App\Http\Controllers\Admin\AnnouncementController;
use App\Http\Controllers\Admin\LevelController;
use App\Http\Controllers\Admin\ClassController;
use App\Http\Controllers\Admin\SubjectController;
use App\Http\Controllers\Admin\TeacherController;
use App\Http\Controllers\Admin\ClassTeacherController;
use App\Http\Controllers\Admin\StudentController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\RoleController;
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
    Route::resource('levels',LevelController::class);
    Route::resource('classes',ClassController::class);
    Route::resource('subjects',SubjectController::class);
    Route::resource('teachers',TeacherController::class);
    Route::resource('class_teachers',ClassTeacherController::class);
    Route::get('getClasses/{id}',[ClassTeacherController::class,'getClass'])->name('getclass');
    Route::resource('/students',StudentController::class);
<<<<<<< HEAD


=======
    Route::resource('roles', RoleController::class);
    Route::resource('admins', AdminController::class);
>>>>>>> 621abb70c437e3f3f29f19338634d58b66875a3d
});
