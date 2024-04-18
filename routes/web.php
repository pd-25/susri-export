<?php

use App\Http\Controllers\front\IndexController;
use App\Http\Controllers\AdminController;
use App\Http\Middleware\AdminMiddleware;
use Illuminate\Support\Facades\Route;


Route::get('/', [IndexController::class, 'index'])->name('front.home');
Route::get('/about-us', [IndexController::class, 'aboutUs'])->name('front.about-us');
Route::get('/contact-us', [IndexController::class, 'contactUs'])->name('front.contact-us');
Route::get('/our-products', [IndexController::class, 'ourProducts'])->name('products');
Route::get('/products/{id}', [IndexController::class, 'show'])->name('products.show');


//admin routes --------------------->
// Route::get('/admin', [AdminController::class, 'index']);
Route::get('/admin-products', [AdminController::class, 'productsAdmin']);
Route::get('delete-product/{id}', [AdminController::class, 'deleteProduct'])->name('delete.product');
Route::post('/addnew-product', [AdminController::class, 'addnewProduct']);
Route::post('/update-product', [AdminController::class, 'updateProduct']);

// admin login ---------------------->
// Admin Login Route
Route::view('/admin/login', 'admin.logAdmin')->name('admin.logAdmin');
Route::post('/admin/login', [AdminController::class, 'login'])->name('admin.login');

Route::middleware(['auth'])->group(function () {
    Route::view('/admin', 'admin.index')->name('admin.dashboard');
});


