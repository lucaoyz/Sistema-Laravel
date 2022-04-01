<?php

use App\Http\Controllers\FinanceiroController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProdutosController;
use App\Http\Controllers\TreinoController;
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

/* Rotas padroes (login/Registro/Dashboard) */
Route::get('/admin', [LoginController::class, 'dashboard'])->name('admin');
Route::get('/admin/login', [LoginController::class, 'loginForm'])->name('admin.login');
Route::get('/admin/registro', [LoginController::class, 'registroForm'])->name('admin.registro');

/* Usuarios */
Route::get('/admin/perfil', [UserController::class, 'perfil'])->name('admin.perfil');
Route::get('/admin/usuarios', [UserController::class, 'usuarios'])->name('admin.usuarios');
    /* ideia */ Route::get('/admin/perfil/notificacoes', [UserController::class, 'notificacoes'])->name('admin.notificacoes');

/* Rotas para o Financeiro */
Route::get('/admin/financeiro', [FinanceiroController::class, 'financeiro'])->name('admin.financeiro');

/* Rotas para os treinos */
Route::get('/admin/treino', [TreinoController::class, 'treino'])->name('admin.treino');




