<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CardController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\AssessmentsController;
use App\Http\Controllers\Api\AddressesController;
use App\Http\Controllers\Api\AddressUserProductController;
use App\Http\Controllers\Api\CartController;
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

Route::group(['middleware' => 'auth:api'], function () {
    // Usuário
    Route::get('/user', [PassportAuthController::class, 'userInfo']);
    Route::post('/logout', [PassportAuthController::class, 'logout']);

    // Cartões
    Route::get('/cards/user', [CardController::class, 'showCardUser']);
    Route::apiResource('cards', CardController::class);

    // Produtos
    Route::get('/products/showOne', [ProductController::class, 'showOne']);
    Route::get('/products/user', [ProductController::class, 'showProductsUser']);
    Route::get('/products/filter', [ProductController::class, 'filter']);
    Route::apiResource('products', ProductController::class);

    // Categorias
    Route::apiResource('categories', CategoryController::class);

    // Avaliação
    Route::get('/assessments/user', [AssessmentsController::class, 'user']);
    Route::get('/assessments/product', [AssessmentsController::class, 'product']);
    Route::apiResource('assessments', AssessmentsController::class);

    // Endereços
    Route::get('addresses/user', [AddressesController::class, 'showAddressesUser']);
    Route::apiResource('addresses', AddressesController::class);

    // Relacionamento entre Endereços - Usuario/Produto
    Route::apiResource('address_user_product', AddressUserProductController::class);

    // Pedido de aluguel
    Route::get('cart/user', [CartController::class, 'showCartUser']);
    Route::apiResource('cart', CartController::class);
});

// Autenticação
Route::post('/register', [PassportAuthController::class, 'register']);
Route::post('/login', [PassportAuthController::class, 'login']);
Route::patch('/recoverPassword', [PassportAuthController::class, 'recoverPassword']);
