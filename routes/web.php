<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Middleware\CheckRole;

    Route::get('login',[AdminController::class,'login'])->name('login');
    Route::post('admin/login',[AdminController::class,'checklogin']);
    Route::get('logout',[AdminController::class,'logout'])->name('logout');
    Route::get('register',[AdminController::class,'register']);
    Route::post('admin/register',[AdminController::class,'registeruser']);


Route::prefix('/')->name('admin.')->middleware(['auth', 'checkRole:Admin'])->group(function () {
    Route::get('admin',[AdminController::class,'index'])->name('dashboard');
    Route::get('dashboard',[AdminController::class,'adminDashboard'])->name('adminDashboard');
    Route::get('addUser',[AdminController::class,'addUser'])->name('addUser');
    Route::post('AddUser',[AdminController::class,'store'])->name('store.addUser');
    Route::get('showUser',[AdminController::class,'showUser'])->name('showUser');
    Route::get('infoUser={id}',[AdminController::class,'infoUser'])->name('infoUser');
    Route::get('editUser={id}',[AdminController::class,'editUser'])->name('editUser');
    Route::post('updateUser={id}',[AdminController::class,'updateUser'])->name('updateUser');
    Route::get('deleteUser={id}',[AdminController::class,'deleteUser'])->name('deleteUser');
});

Route::get('foodDashboard',[AdminController::class,'food'])->name('user.dashboard');