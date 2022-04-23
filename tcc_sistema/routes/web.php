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

        /* Rotas dashboard */
        Route::get('/', function(){
            return view('admin.dashboard');
        })->name('admin');

        /* Usuarios */
        Route::get('/perfil', function(){
            return view('admin.perfil');
        })->name('admin.perfil');
        Route::get('/usuarios', function(){
            return view('admin.usuarios');
        })->name('admin.usuarios');

        /* Rotas para o Financeiro */
        Route::get('/financeiro', function(){
            return view('admin.financeiro');
        })->name('admin.financeiro');

        /* Rotas para os treinos */
        Route::get('/treino', function(){
            return view('admin.treino');
        })->name('admin.treino');

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


