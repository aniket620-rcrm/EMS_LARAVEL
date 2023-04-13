<?php

use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SalaryController;
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
Route::get('/login',[AuthenticationController::class , 'login']);
Route::post('/login',[AuthenticationController::class , 'login']);

// Route::post('/send-email', [MailController::class , 'mail']);

// Route::get('/get-user/{id?}' , [HomeController::class , 'index']);
Route::get('/latestSalary/{userId?}' , [SalaryController::class, 'latestSalary']);
Route::middleware('auth:api')->get('/get-user' , [HomeController::class , 'index']);