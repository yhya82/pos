<?php

use App\Http\Controllers\Api\SaleController;
use App\Http\Controllers\Api\ProductController;
use Illuminate\Support\Facades\Route;



Route::middleware(['web','auth:sanctum'])->group(function() {

Route::get('products',[ProductController::class,'index']);
Route::get('products/{product}',[ProductController::class,'show']);
Route::post('products',[ProductController::class,'store']);
Route::put('products/{product}',[ProductController::class,'update']);
Route::delete('products/{product}',[ProductController::class,'destroy']);


Route::get('sale/pos',[SaleController::class,'pos']);
Route::get('sale/index',[SaleController::class,'index']);
Route::get('sale/edit',[SaleController::class,'edit']);
Route::post('sale/add-item',[SaleController::class,'addItem']);
Route::post('sale/completeSale',[SaleController::class,'completeSale']);
Route::delete('sale/removeItem/{saleItem}',[SaleController::class,'removeItem']);
Route::put('sale/{sale}',[SaleController::class,'update']);
});

//the web in the middleware enables sessions and cookies ithout it laravel wont see logged in user from the session
//auth:sanctum checks if the user is authenticated/ logged in.