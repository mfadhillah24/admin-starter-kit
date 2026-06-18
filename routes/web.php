<?php

use App\Http\Controllers\DashboardControlller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::get('/', [DashboardControlller::class, 'index'])->name('dashboard.index');
Route::resource('/user', UserController::class);
