<?php

use App\Http\Controllers\FinanceiroController;
use App\Http\Controllers\TreinoController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AlunoController;
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





Auth::routes();

/*------------------------------------------
--------------------------------------------
LISTA DE ROTAS DE ALUNOS/NORMAL USERS
--------------------------------------------
--------------------------------------------*/
Route::middleware(['auth', 'user-access:user'])->group(function () {

    Route::get('/home', [HomeController::class, 'index'])->name('home');
});

/*------------------------------------------
--------------------------------------------
LISTA DE ROTAS DE ADMIN
--------------------------------------------
--------------------------------------------*/
Route::middleware(['auth', 'user-access:admin'])->group(function () {

    Route::prefix('admin')->group(function(){

        Route::get('/home', [HomeController::class, 'adminHome'])->name('admin.home');

        // Cadastro de aluno
        Route::resource('/alunos', AlunoController::class);

});

});



/*------------------------------------------
--------------------------------------------
lISTA DE ROTAS DE PROFESSOR
--------------------------------------------
--------------------------------------------*/
Route::middleware(['auth', 'user-access:professor'])->group(function () {

    Route::get('/professor/home', [HomeController::class, 'professorHome'])->name('professor.home');
});


