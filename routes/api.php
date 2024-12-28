<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SubcategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\AuthController;

Route::post('/register', [AuthController::class, 'register']); // Register User or Admin
Route::post('/login', [AuthController::class, 'login'])->name('login');      // Login User or Admin
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum'); // Logout
Route::apiResource('orders', OrderController::class);
Route::apiResource('cart-items', CartController::class);
Route::apiResource('users', UserController::class);
Route::apiResource('categories', CategoryController::class);
Route::apiResource('subcategories', SubcategoryController::class);
Route::apiResource('products', ProductController::class);


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::middleware(['auth:sanctum', 'admin'])->group(function () {
    Route::get('/admin/dashboard', function () {
        return response()->json(['message' => 'Welcome, Admin!']);
    });
});


Route::middleware(['auth:sanctum', 'role:user'])->group(function () {
    Route::get('/user/dashboard', function () {
        return response()->json([
            'message' => 'Welcome to the User Dashboard',
            'user' => auth()->user(), // Fetch the logged-in user's data
        ]);
    });
});


