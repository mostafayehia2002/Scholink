<?php

use App\Http\Controllers\Api\CommentController;
use App\Http\Controllers\Api\ContentController;
use App\Http\Controllers\Api\LevelController;
use App\Http\Controllers\Api\MarkController;
use App\Http\Controllers\Api\MaterialController;
use App\Http\Controllers\Api\NotificationController;
use App\Http\Controllers\Api\ParentConversationController;
use App\Http\Controllers\Api\ReactionController;
use App\Http\Controllers\Api\RegisterController;
use App\Http\Controllers\Api\StudentConversationController;
use App\Http\Controllers\Api\SubCategoryController;
use App\Http\Controllers\Api\SubjectController;
use App\Http\Controllers\Api\TableController;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\StudentController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthenticationController;
use App\Http\Controllers\Api\ParentStudentController;
use Mcamara\LaravelLocalization\LaravelLocalization;

use App\Traits\GeneralResponse;
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

Route::fallback(function () {
    return  response()->json(['IsSuccess' => false, 'statusCode' => 404, 'error' => 'route not found'], 404);
});
//this route  student and parents login operation
Route::group(
    ['middleware' => 'api.lang'],
    function () {
        Route::controller(AuthenticationController::class)->group(function () {
            Route::post('login', 'login');
            Route::post('reset-password', 'resetPassword');
            Route::post('confirm-otp', 'confirmOtp');
            Route::post('new-password', 'newPassword');
        });
        Route::controller(RegisterController::class)->group(function () {
            Route::post('register', 'register');
            Route::post('register/confirmed', 'registerConfirmed');
        });
        Route::get('/levels', [LevelController::class, 'getLevels']);
        //media
        Route::get('/posts', [ContentController::class, 'getPosts']);
        Route::get('/react', [ReactionController::class, 'reaction']);
        Route::post('/comment', [CommentController::class, 'comment']);
        Route::get('/comment/delete', [CommentController::class, 'deleteComment']);
        Route::post('/comment/update', [CommentController::class, 'updateComment']);
        Route::get('/news', [SubCategoryController::class, 'getNews']);
        Route::get('/announcements', [SubCategoryController::class, 'getAnnouncements']);
        Route::get('/guidelines', [ContentController::class, 'getGuidelines']);
        Route::get('/visions', [ContentController::class, 'getVision']);


        //student routes
        Route::group([
            'prefix' => 'auth/student',
            'middleware' => 'auth:student'
        ], function () {
            Route::controller(StudentController::class)->group(function () {
                Route::post('/logout',  'logout');
                Route::post('/refresh',  'refresh');
                Route::post('/profile', 'profile');
                Route::post('/change-password', 'changePassword');
            });
            Route::controller(SubjectController::class)->group(function () {
                Route::get('/subjects', 'getStudentSubjects');
                Route::post('/assignments', 'getAssignments');
                Route::post('/upload-homework', 'uploadHomework');
                Route::get('/assignments/grade', 'getAssignmentsGrade');
                Route::get('/subject/month-exams/grade', 'getMonthExamsGrade');
            });
            Route::get('/levels', [LevelController::class, 'getStudentLevels']);
            Route::get('/marks', [MarkController::class, 'getStudentMarks']);
            Route::get('/table', [TableController::class, 'getStudentTable']);
            Route::get('/materials', [MaterialController::class, 'getMaterials']);

            //chat
            Route::get('/participants',[StudentConversationController::class,'getParticipants']);
            Route::get('/conversations',[StudentConversationController::class,'getConversations']);
            Route::get('/messages',[StudentConversationController::class,'getMessages']);
            Route::Post('/send-message',[StudentConversationController::class,'sendMessage']);

            //notifications
            Route::get('/notifications',[NotificationController::class,'getAllNotifications']);
            Route::get('/unread-notifications',[NotificationController::class,'getUnReadNotifications']);
            Route::get('/delete-notifications',[NotificationController::class,'deleteAllNotifications']);

        });



        //parents routes
        Route::group([
            'prefix' => 'auth/parent',
            'middleware' => 'auth:parent'
        ], function () {
            Route::controller(ParentStudentController::class)->group(function () {
                Route::post('/logout',  'logout');
                Route::post('/refresh', 'refresh');
                Route::post('/profile',  'profile');
                Route::post('/update-profile',  'updateProfile');
                Route::post('/change-password', 'changePassword');
                Route::get('/children','getChildren');
                Route::post('/add-child','addNewChild');
            });
            Route::get('/table', [TableController::class, 'getTable']);
            Route::get('/levels', [LevelController::class, 'getLevel']);
            Route::get('/marks', [MarkController::class, 'getMarks']);


            //chat
            Route::get('/participants',[ParentConversationController::class,'getParticipants']);
            Route::get('/conversations',[ParentConversationController::class,'getConversations']);
            Route::get('/messages',[ParentConversationController::class,'getMessages']);
            Route::Post('/send-message',[ParentConversationController::class,'sendMessage']);

            //notifications
            Route::get('/notifications',[NotificationController::class,'getAllNotifications']);
            Route::get('/unread-notifications',[NotificationController::class,'getUnReadNotifications']);
            Route::get('/delete-notifications',[NotificationController::class,'deleteAllNotifications']);
        });
    }
);
