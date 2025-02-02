<?php

use App\Http\Controllers\AuthenticationController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Middleware\CheckRole;


Route::get('/', function () {
    return view('home');
})->name('home');
Route::get('login', [AuthenticationController::class, 'login'])->name('login');
Route::post('login', [AuthenticationController::class, 'checklogin']);
Route::get('logout', [AdminController::class, 'logout'])->name('logout');
Route::get('register', [AuthenticationController::class, 'register']);
Route::post('admin/register', [AuthenticationController::class, 'registeruser']);

Route::get('auth/google/redirect', [AuthenticationController::class, 'redirectToGoogle'])->name('auth.google.redirect');
Route::get('auth/google/callback', [AuthenticationController::class, 'handleGoogleCallback']);

// Route::get('auth/facebook/redirect', [AuthenticationController::class, 'redirectToFacebook'])->name('auth.facebook.redirect');
// Route::get('auth/facebook/callback', [AuthenticationController::class, 'handleFacebookCallback']);



Route::prefix('/')->name('admin.')->middleware(['auth', 'checkRole:Admin'])->group(function () {
    Route::get('admin', [AdminController::class, 'index'])->name('dashboard');
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
});

Route::get('foodDashboard', [AdminController::class, 'food'])->name('user.dashboard');
Route::get('22', [AdminController::class, 'food'])->name('/');