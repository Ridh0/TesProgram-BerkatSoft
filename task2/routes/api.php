<?php

use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\RegisterController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PosController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProductController;
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
Route::resource('/post', PostController::class);
Route::resource('/product', ProductController::class);
Route::resource('/order', OrderController::class);
Route::resource('/customer', CustomerController::class);
Route::get('/getting/product/{id}',[PosController::class,'GetProduct']);
Route::get('/addTocart/{id}',[PosController::class,'AddTocart']);
Route::get('/allCart',[PosController::class,'AllCart']);
Route::get('/removeCart/{id}',[PosController::class,'RemoveCart']);
Route::get('/increment/{id}',[PosController::class,'Increment']);
Route::get('/decrement/{id}',[PosController::class,'Decrement']);

Route::post('/login', [LoginController::class,'index']);
Route::get('/logout', [LoginController::class,'logout']);
Route::post('/register', [RegisterController::class,'index']);

Route::get('/vat',[PosController::class,'Vat']);
Route::post('/orderdone',[PosController::class,'OrderDone']);
