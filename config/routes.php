<?php

use App\Controllers\AdminController;
use App\Controllers\CategoryController;
use App\Controllers\HomeController;
use App\Controllers\LoginController;
use App\Controllers\ManhwaController;
use App\Controllers\RegisterController;
use App\Controllers\ReviewController;
use App\Kernel\Router\Route;
use App\Middleware\AuthMiddleware;
use App\Middleware\GuestMiddleware;

return [
   Route::get('/', [HomeController::class, 'index']),
   Route::get('/manhwa', [ManhwaController::class, 'show']),
   Route::get('/random', [ManhwaController::class, 'random']),
   Route::post('/search', [ManhwaController::class, 'search']),
   Route::get('/all', [ManhwaController::class, 'all']),
   Route::get('/category', [ManhwaController::class, 'category']),


   Route::get('/admin', [AdminController::class, 'index'], [AuthMiddleware::class]),

   Route::get('/admin/manhwas/add', [ManhwaController::class, 'add'], [AuthMiddleware::class]), 
   Route::post('/admin/manhwas/add', [ManhwaController::class, 'store'], [AuthMiddleware::class]),

   Route::get('/admin/categories/add', [CategoryController::class, 'add'], [AuthMiddleware::class]),
   Route::post('/admin/categories/add', [CategoryController::class, 'store'], [AuthMiddleware::class]),
   Route::post('/admin/categories/edit', [CategoryController::class, 'edit'], [AuthMiddleware::class]),
   Route::post('/admin/categories/delete', [CategoryController::class, 'delete'], [AuthMiddleware::class]),
   Route::get('/admin/categories/update', [CategoryController::class, 'edit'], [AuthMiddleware::class]),
   Route::post('/admin/categories/update', [CategoryController::class, 'update'], [AuthMiddleware::class]),

   Route::get('/admin/manhwas/add', [ManhwaController::class, 'create'], [AuthMiddleware::class]),
   Route::post('/admin/manhwas/add', [ManhwaController::class, 'store'], [AuthMiddleware::class]),
   Route::post('/admin/manhwas/edit', [ManhwaController::class, 'edit'], [AuthMiddleware::class]),
   Route::post('/admin/manhwas/delete', [ManhwaController::class, 'delete'], [AuthMiddleware::class]),
   Route::get('/admin/manhwas/update', [ManhwaController::class, 'edit'], [AuthMiddleware::class]),
   Route::post('/admin/manhwas/update', [ManhwaController::class, 'update'], [AuthMiddleware::class]),

   Route::get('/register', [RegisterController::class, 'index'], [GuestMiddleware::class]),
   Route::post('/register', [RegisterController::class, 'register']),

   Route::get('/login', [LoginController::class, 'index'], [GuestMiddleware::class]),
   Route::post('/login', [LoginController::class, 'login']),
   Route::post('/logout', [LoginController::class, 'logout'], [AuthMiddleware::class]),

   Route::post('/reviews/add', [ReviewController::class, 'store'], [AuthMiddleware::class]),
];