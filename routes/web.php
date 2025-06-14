<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Auth;

// Trang đăng nhập & đăng ký
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Bảo vệ route /products chỉ cho user đã login
Route::middleware(['auth'])->group(function () {
    // lấy danh sách sản phẩm
    Route::get('/products', [ProductController::class, 'index'])->name('products.index');

    // lấy danh sách review sản phẩm
    Route::get('/products/{id}/reviews', [ReviewController::class, 'index'])->name('products.reviews');

    // đăng bài review sản phẩm
    Route::get('/products/{product_id}/reviews/create', [ReviewController::class, 'create'])->name('reviews.create');
    Route::post('/products/{id}/reviews', [ReviewController::class, 'store'])->name('reviews.store');


    // cập nhật thông tin cá nhân
     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');
});
