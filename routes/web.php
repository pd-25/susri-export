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
Route::post('/admin/login', [AdminController::class, 'login'])->name('admin.login');






//admin routes --------------------->
// Route::middleware([Admin::class])->group(function () {
    Route::group(['middleware'=>'admin'],function(){
    Route::get('/admin-dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin-products', [AdminController::class, 'productsAdmin']);
    Route::get('delete-product/{id}', [AdminController::class, 'deleteProduct'])->name('delete.product');
    Route::post('/addnew-product', [AdminController::class, 'addnewProduct']);
    Route::get('log-out', [AdminController::class, 'adminLogout'])->name('admin.logout');
    Route::post('/update-product', [AdminController::class, 'updateProduct']);
});

