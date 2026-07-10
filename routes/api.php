<?php

use App\Http\Controllers\UserController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/check', [UserController::class, 'check'])->name('user.check');
Route::post('/checkExistMobile', [UserController::class, 'checkExistMobile'])->name('user.checkExistMobile');
Route::post('/checkExistTelephone', [UserController::class, 'checkExistTelephone'])->name('user.checkExistTelephone');
