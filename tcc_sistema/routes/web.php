<?php

use App\Http\Controllers\FinanceiroController;
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
Route::get('/admin/registro', [LoginController::class, 'registerForm'])->name('admin.register');
/* temporario, será feito alteração após reforma e criação de views para o sistema */
Route::get('/admin/perfil', [UserController::class, 'profile'])->name('admin.profile');
Route::get('/admin/tabelas', [UserController::class, 'tables'])->name('admin.tables');
Route::get('/admin/notificacoes', [UserController::class, 'notificacoes'])->name('admin.notificacoes');
Route::get('/admin/financeiro', [FinanceiroController::class, 'financeiro'])->name('admin.financeiro');



