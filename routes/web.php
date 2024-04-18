<?php

use App\Http\Controllers\front\IndexController;
use App\Http\Controllers\AdminController;
use App\Http\Middleware\Admin;
use App\Http\Middleware\AdminMiddleware;
use Illuminate\Support\Facades\Route;


Route::get('/', [IndexController::class, 'index'])->name('front.home');
Route::get('/about-us', [IndexController::class, 'aboutUs'])->name('front.about-us');
Route::get('/contact-us', [IndexController::class, 'contactUs'])->name('front.contact-us');
Route::get('/our-products', [IndexController::class, 'ourProducts'])->name('products');
Route::get('/product/{id}', [IndexController::class, 'singleproduct']);


Route::get('/admin/login', [IndexController::class, 'adminlogin'])->name('admin.logAdmin');




//admin routes --------------------->
// Route::middleware([Admin::class])->group(function () {
    Route::group(['middleware'=>'admin'],function(){
    Route::get('/admin', [AdminController::class, 'index']);
    Route::get('/admin-products', [AdminController::class, 'productsAdmin']);
    Route::get('delete-product/{id}', [AdminController::class, 'deleteProduct'])->name('delete.product');
    Route::post('/addnew-product', [AdminController::class, 'addnewProduct']);
    Route::post('/update-product', [AdminController::class, 'updateProduct']);
});

