<?php

use App\Http\Controllers\TestController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\BookController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\BookReturnController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\ReaderController;

use App\Http\Controllers\AuthController;

Route::post('/login', [AuthController::class, 'login']);
Route::middleware('auth:api')->group(function () {
    Route::get('/me', [AuthController::class, 'me']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/refresh', [AuthController::class, 'refresh']);
});



Route::resource('books', BookController::class);
Route::resource('loans', LoanController::class);
Route::resource('book_returns', BookReturnController::class);
Route::resource('authors', AuthorController::class);
Route::resource('readers', ReaderController::class);

Route::get('/', function () {
    return view('welcome');
});

Route::get('/test', [TestController::class, 'test']);

Route::get('/products', [ProductController::class, 'getProducts']);
Route::get('/products/{id}', [ProductController::class, 'getProductItem']);
Route::post('/products', [ProductController::class, 'createProduct']);