<?php

use App\Http\Controllers\AuthenticationController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\FoodController;
use App\Http\Middleware\CheckRole;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductCatalogController;


Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('login', [AuthenticationController::class, 'login'])->name('login');
Route::post('login', [AuthenticationController::class, 'checklogin']);
Route::get('logout', [AdminController::class, 'logout'])->name('logout');
Route::get('register', [AuthenticationController::class, 'register']);
Route::post('admin/register', [AuthenticationController::class, 'registeruser']);

Route::get('auth/google/redirect', [AuthenticationController::class, 'redirectToGoogle'])->name('auth.google.redirect');
Route::get('auth/google/callback', [AuthenticationController::class, 'handleGoogleCallback']);

// Route::get('auth/facebook/redirect', [AuthenticationController::class, 'redirectToFacebook'])->name('auth.facebook.redirect');
// Route::get('auth/facebook/callback', [AuthenticationController::class, 'handleFacebookCallback']);


///////////////////////////////////////////////////User//////////////////////////////////////////////////////////
Route::get('product-catalog', [ProductCatalogController::class, 'index'])->name('product-catalog');
Route::get('food-list', [FoodController::class, 'index'])->name('food-list');




/////////////////////////////////////////////Admin///////////////////////////////////////////////
Route::prefix('/')->name('admin.')->middleware(['auth', 'checkRole:Admin'])->group(function () {
    // Admin page routes
    Route::get('dashboard', [AdminController::class, 'adminDashboard'])->name('adminDashboard');
    Route::get('addUser', [AdminController::class, 'addUser'])->name('addUser');
    Route::post('AddUser', [AdminController::class, 'store'])->name('store.addUser');
    Route::get('showUser', [AdminController::class, 'showUser'])->name('showUser');
    Route::get('infoUser={id}', [AdminController::class, 'infoUser'])->name('infoUser');
    Route::get('editUser={id}', [AdminController::class, 'editUser'])->name('editUser');
    Route::post('updateUser={id}', [AdminController::class, 'updateUser'])->name('updateUser');
    Route::get('deleteUser={id}', [AdminController::class, 'deleteUser'])->name('deleteUser');
    Route::get('searchUser', [AdminController::class, 'searchUsers'])->name('searchUser');
    Route::post('lock-account/{id}', [AdminController::class, 'lockAccount'])->name('admin.lockAccount');

    // Admin Shop page routes
    Route::get('addShop', [ShopController::class, 'addShop'])->name('addShop');
    Route::post('addShop', [ShopController::class, 'storeShop'])->name('storeShop');
    Route::get('editShop={id}', [ShopController::class, 'editShop'])->name('editShop');
    Route::post('updateShop={id}', [ShopController::class, 'updateShop'])->name('updateShop');
    Route::get('deleteShop={id}', [ShopController::class, 'deleteShop'])->name('deleteShop');
    Route::get('searchShop', [ShopController::class, 'searchShop'])->name('searchShop');
    Route::get('infoShop={id}', [ShopController::class, 'infoShop'])->name('infoShop');
    Route::get('showShop', [ShopController::class, 'showShop'])->name('showShop');
    Route::post('lockShop/{id}', [ShopController::class, 'lockShop'])->name('lockShop');

    // Admin Food page routes
    Route::get('addFood', [FoodController::class, 'addFood'])->name('addFood');
    Route::post('addFood', [FoodController::class, 'storeFood'])->name('storeFood');
    Route::get('editFood={id}', [FoodController::class, 'editFood'])->name('editFood');
    Route::post('updateFood={id}', [FoodController::class, 'updateFood'])->name('updateFood');
    Route::get('deleteFood={id}', [FoodController::class, 'deleteFood'])->name('deleteFood');
    Route::get('searchFood', [FoodController::class, 'searchFood'])->name('searchFood');
    Route::get('infoFood={id}', [FoodController::class, 'infoFood'])->name('infoFood');
    Route::get('showFood', [FoodController::class, 'food'])->name('showFood');
    Route::post('lockFood/{id}', [FoodController::class, 'lockFood'])->name('lockFood');
});

// Route::get('foodDashboard', [AdminController::class, 'food'])->name('user.dashboard');
Route::get('22', [AdminController::class, 'food'])->name('/');