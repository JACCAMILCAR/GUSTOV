<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\ReportController;
Route::resource('users', UserController::class);
Route::resource('login', AuthController::class);
Route::resource('menus', MenuController::class);
Route::resource('sales', SaleController::class);
Route::resource('reports', ReportController::class);