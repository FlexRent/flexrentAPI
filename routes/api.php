<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CardController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\AssessmentsController;
use App\Http\Controllers\Api\AddressesController;
use App\Http\Controllers\Api\PassportAuthController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('/register', [PassportAuthController::class, 'register']);
Route::post('/login', [PassportAuthController::class, 'login']);
Route::post('/logout', [PassportAuthController::class, 'logout'])->middleware('auth:api');
Route::get('/user', [PassportAuthController::class, 'userInfo'])->middleware('auth:api');

Route::apiResource('cards', CardController::class)->middleware('auth:api');
Route::apiResource('products', ProductController::class)->middleware('auth:api');
Route::apiResource('categories', CategoryController::class)->middleware('auth:api');
Route::apiResource('assessments', AssessmentsController::class)->middleware('auth:api');
Route::apiResource('addresses', AddressesController::class)->middleware('auth:api');
