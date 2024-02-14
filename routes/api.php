<?php

use App\Http\Controllers\Api\CommentController;
use App\Http\Controllers\Api\ContentController;
use App\Http\Controllers\Api\ReactionController;
use App\Http\Controllers\Api\RegisterController;
use App\Http\Controllers\Api\SubCategoryController;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\StudentController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthenticationController;
use App\Http\Controllers\Api\ParentStudentController;
use Mcamara\LaravelLocalization\LaravelLocalization;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return response()->json('welcome to smart school system api');
});

//this route  student and parents login operation
Route::group(['middleware' => 'api.lang'],
    function(){
Route::controller(AuthenticationController::class)->group(function () {
    Route::post('login', 'login');
    Route::post('reset-password', 'resetPassword');
    Route::post('confirm-otp', 'confirmOtp');
    Route::post('new-password', 'newPassword');
});
Route::controller(RegisterController::class)->group(function (){
    Route::post('register', 'register');
    Route::post('register/confirmed','registerConfirmed');
});
//media
        Route::get('/posts',[ContentController::class,'getPosts']);
        Route::get('/react',[ReactionController::class,'reaction']);
        Route::post('/comment',[CommentController::class,'comment']);
        Route::get('/comment/delete',[CommentController::class,'deleteComment']);
        Route::post('/comment/update',[CommentController::class,'updateComment']);
        Route::get('/news',[SubCategoryController::class,'getNews']);
        Route::get('/announcements',[SubCategoryController::class,'getAnnouncements']);
        Route::get('/guidelines',[ContentController::class,'getGuidelines']);
        Route::get('/visions',[ContentController::class,'getVision']);


//student routes
Route::group([
    'prefix'=>'auth/student',
    'middleware'=>'auth:student'
],function (){
    Route::controller(StudentController::class)->group(function () {
        Route::post('/logout',  'logout');
        Route::post('/refresh',  'refresh');
        Route::post('/profile', 'profile');
        Route::post('/change-password', 'changePassword');
    });
});


//parents routes
Route::group([
    'prefix'=>'auth/parent',
    'middleware'=>'auth:parent'
],function (){
    Route::controller(ParentStudentController::class)->group(function () {
        Route::post('logout',  'logout');
        Route::post('refresh', 'refresh');
        Route::post('profile',  'profile');
        Route::post('update-profile',  'updateProfile');
        Route::post('change-password', 'changePassword');
    });
});

});