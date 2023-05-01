<?php

use App\Http\Controllers\Api\getImage;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\ContactFormController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LeaveController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SalaryController;
use App\Http\Controllers\IndividualController;
use App\Http\Controllers\MailController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Route::get('test' , function(){
//     return 'Success';
// });

Route::middleware(['auth:api'])->group(function () {
    Route::get('/get-user', [HomeController::class, 'index']);
    Route::get('/role', [HomeController::class, 'role']);
    Route::post('/leave-request', [LeaveController::class, 'leaveRequest']);
    Route::post('/register', [AuthenticationController::class, 'register']);
    Route::get('/latestSalary/{userId?}', [SalaryController::class, 'latestSalary']);
    Route::get('/Tax/{userId?}', [SalaryController::class, 'Tax']);
    Route::get('/leave/{userId?}', [LeaveController::class, 'RecentLeave']);
   

});

Route::post('/upload', [ImageController::class , 'upload']);
Route::get('/getImage/user/{userId}/images', [getImage::class , 'index']);


Route::post('/login', [AuthenticationController::class, 'login']);


Route::middleware(['auth:api'])->group(function () {
    Route::post('/users/update', [UserController::class, 'update']);
    Route::apiResource('/users', UserController::class);
    Route::post('/users/filter', [UserController::class, 'filter']);
    Route::post('/leaves/update', [LeaveController::class, 'update']);
    Route::post('/leaves/filter', [LeaveController::class, 'filter']);
    Route::apiResource('/leaves', LeaveController::class);
    Route::post('/salary/generate', [SalaryController::class, 'generateSalary']);
});


Route::middleware(['auth:api'])->group(function () {
    Route::get('user/profile/{id}', [IndividualController::class, 'view']);
    Route::post('/updateprofile', [IndividualController::class, 'updateProfile']);
    Route::get('user/salary/{id}', [IndividualController::class, 'salary']);
    Route::get('user/leaves/{id}', [IndividualController::class, 'leave']);
    Route::get('send/email', [MailController::class, 'sendEmail']);
    Route::post('/updateprofile', [IndividualController::class, 'updateProfile']);
    Route::post('/salaries/filter', [SalaryController::class, 'filter']);
    Route::post('/salaries/pay', [SalaryController::class, 'makeSalaryPaid']);
    Route::get('/salaries', [SalaryController::class, 'index']);
});