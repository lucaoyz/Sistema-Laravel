<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/admin', [LoginController::class, 'dashboard'])->name('admin');
Route::get('/admin/login', [LoginController::class, 'loginForm'])->name('admin.login');
Route::get('/admin/register', [LoginController::class, 'registerForm'])->name('admin.register');
/* temporario, será feito alteração após reforma e criação de views para o sistema */
Route::get('/admin/profile', [UserController::class, 'profile'])->name('admin.profile');



