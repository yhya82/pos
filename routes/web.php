<?php
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;


use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth/login');
});


//route for admin

Route::middleware('auth','role:admin')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    Route::resource('products',ProductController::class);
    Route::resource('categorys',CategoryController::class);
    Route::resource('supplier',SupplierController::class);
    Route::resource('users',UserController::class);
    Route::get('/dashboard',[DashboardController::class,'index'])->name('dashboard'); 

//only admins return to the middleware after testing
    Route::get('sale/edit',[SaleController::class,'edit'])->name('sale.edit');
    Route::post('sale/{sale}/edit',[SaleController::class,'update'])->name('sale.update');
});

//routes for cashier
Route::middleware(['auth'])->group(function () {
    Route::get('sale/pos',[SaleController::class,'pos'])->name('sale.pos');
    Route::get('sale/index',[SaleController::class,'index'])->name('sale.index');
    Route::post('sales/additem',[SaleController::class,'addItem'])->name('sales.additem');
    Route::post('sales/completesale',[SaleController::class, 'completeSale'])->name('sales.completesale');
    Route::delete('sales/removeitem/{saleItem}',[SaleController::class,'removeItem'])->name('sales.removeitem');
    Route::delete('sale/{sale}',[SaleController::class,'destroy'])->name('sale.destroy');

 });


require __DIR__.'/auth.php';
