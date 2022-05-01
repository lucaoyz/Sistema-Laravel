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

    Route::prefix('aluno')->group(function(){

        Route::get('/home', [HomeController::class, 'index'])->name('aluno.home');

        /* Rotas dashboard */
        Route::get('/', function(){
            return view('aluno.dashboard');
        })->name('aluno');

        /* Usuarios */
        Route::get('/perfil', function(){
            return view('aluno.perfil');
        })->name('aluno.perfil');

        /* Rotas para os treinos */
        Route::get('/treino', function(){
            return view('aluno.treino');
        })->name('aluno.treino');

    });
});

/*------------------------------------------
--------------------------------------------
LISTA DE ROTAS GERENCIAIS
--------------------------------------------
--------------------------------------------*/
Route::middleware(['auth', 'user-access:admin'])->group(function () {

    Route::prefix('gerencial')->group(function(){

        Route::get('/home', [HomeController::class, 'adminHome'])->name('admin.home');

        // filtro de aluno
        Route::any('/alunos/search', [AlunoController::class, 'search'])->name('alunos.search');

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
        
        Route::get('/usuarios', [AlunoController::class, 'index'])->name('admin.usuarios');

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

    Route::prefix('professor')->group(function(){

        Route::get('/home', [HomeController::class, 'professorHome'])->name('professor.home');

         /* Rotas dashboard */
         Route::get('/', function(){
            return view('professor.dashboard');
        })->name('professor');

        /* Usuarios */
        Route::get('/perfil', function(){
            return view('professor.perfil');
        })->name('professor.perfil');

        /* Rotas para os treinos */
        Route::get('/treino', function(){
            return view('professor.treino');
        })->name('professor.treino');

    });

});

Route::fallback(function () {
    return view('fallback');
});
