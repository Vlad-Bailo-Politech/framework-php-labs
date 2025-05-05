<?php

use App\Http\Controllers\TestController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\BookController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\BookReturnController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\ReaderController;

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