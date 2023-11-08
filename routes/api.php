<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AppointmentController;

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

Route::get('appointments', [AppointmentController::class,'index']);

Route::post('appointments',[AppointmentController::class,'store']);

Route::delete('appointments/{appointment}',[AppointmentController::class,'destroy']);

Route::get('appointments/{appointment}',[AppointmentController::class,'show']);

Route::put('appointments/{appointment}',[AppointmentController::class,'update']);