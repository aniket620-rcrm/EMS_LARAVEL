<?php

use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\ContactFormController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LeaveController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SalaryController;
use App\Http\Controllers\IndividualController;
use App\Http\Controllers\MailController;
use Illuminate\Http\Request;
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

Route::post('/register',[AuthenticationController::class , 'register']);
// Route::get('/login',[AuthenticationController::class , 'login']);
Route::post('/login',[AuthenticationController::class , 'login']);

//Aniket's Api
Route::apiResource('/users',UserController::class);
Route::post('/users/filter',[UserController::class,'filter']);
Route::apiResource('/leaves',LeaveController::class);
Route::post('/leaves/filter',[LeaveController::class,'filter']);
Route::post('/salary/generate',[SalaryController::class,'generateSalary']);
Route::get('/salaries',[SalaryController::class,'index']);


// Route::post('/send-email', [MailController::class , 'mail']);

// Route::get('/get-user/{id?}' , [HomeController::class , 'index']);
Route::get('/latestSalary/{userId?}' , [SalaryController::class, 'latestSalary']);
Route::get('/Tax/{userId?}' , [SalaryController::class , 'Tax']);
Route::get('/leave/{userId?}' , [LeaveController::class , 'RecentLeave']);
Route::middleware('auth:api')->get('/get-user' , [HomeController::class , 'index']);
Route::get('/role' , [HomeController::class , 'role']);
Route::post('/leave-request', [LeaveController::class , 'leaveRequest']);





// Api Aman Tripathi {Don't Enter in my territory}
Route::get('user/profile/{id}' , [IndividualController::class, 'view']);
Route::post('/updateprofile', [IndividualController::class, 'updateProfile']);
Route::get('user/salary/{id}',[IndividualController::class,'salary']);
Route::get('user/leaves/{id}',[IndividualController::class,'leave']);
Route::get('send/email',[MailController::class,'sendEmail']);