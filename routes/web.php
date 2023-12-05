<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\DefaultController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\RoleController as role;
use App\Http\Controllers\UserController as user;
use App\Http\Controllers\CustomerController as customers;
use App\Http\Controllers\AuthenticationController as auth;
use App\Http\Controllers\DashboardController as dashboard;
use App\Http\Controllers\PermissionController as permission;



// Route Authentication
Route::get('/register',[auth::class,'signUpForm'])->name('register');
Route::post('/register',[auth::class,'signUpstore'])->name('register.store');
Route::get('/login',[auth::class,'signinForm'])->name('login');
Route::post('/login',[auth::class,'signInCheck'])->name('login.check');
Route::get('/logout',[auth::class,'singOut'])->name('logOut');

Route::middleware(['checkauth'])->prefix('admin')->group(function(){

    Route::get('dashboard', [dashboard::class,'index'])->name('dashboard');
    Route::get('/product_search', [PurchaseController::class,'product_search'])->name('pur.product_search');
    Route::get('/product_search_data', [PurchaseController::class,'product_search_data'])->name('pur.product_search_data');
    Route::get('/product_search_sales', [SaleController::class,'product_search_data'])->name('sales.product_search_data');
    Route::get('/check_stock', [SaleController::class,'check_stock'])->name('sales.check_stock');

});

Route::middleware(['checkrole'])->prefix('admin')->group(function(){
    Route::resource('user', user::class);
    Route::resource('role', role::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('customers', customers::class);
    Route::resource('suppliers', SupplierController::class);

    // Route Products
    Route::get('/products/export', [ProductController::class, 'export'])->name('products.export');
    Route::get('/products/import', [ProductController::class, 'import'])->name('products.import');
    Route::post('/products/import', [ProductController::class, 'handleImport'])->name('products.handleImport');
    Route::resource('products', ProductController::class);

    // Route Permission
    Route::get('permission/{role}', [permission::class,'index'])->name('permission.list');
    Route::post('permission/{role}', [permission::class,'save'])->name('permission.save');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::get('/profile/settings', [ProfileController::class, 'settings'])->name('profile.settings');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


     // Route Purchases
     Route::resource('purchase', PurchaseController::class);
     Route::get('/purchase-report', [ReportController::class, 'generatePurchaseReport'])->name('purchase-report.generate');
     Route::post('/purchase-report', [ReportController::class, 'generatePurchaseReport']);
     // web.php

Route::get('/purchase/{id}/generate-invoice', [PurchaseController::class,'invoice'])->name('purchase.generate-invoice');

     //Route Sales
     Route::resource('sale', SaleController::class);
     Route::get('/sale-report', [ReportController::class, 'generateSaleReport'])->name('sale-report.generate');
     Route::post('/sale-report', [ReportController::class, 'generateSaleReport']);

     Route::get('/stock', [StockController::class, 'index'])->name('stock.index');


});








