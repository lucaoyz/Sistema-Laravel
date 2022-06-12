<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\UsuariosController;
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

        Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('aluno.home');

        /* Rotas dashboard */
        Route::get('/', function(){
            return view('aluno.dashboard');
        })->name('aluno');

        /* Perfil */
        Route::get('/perfil', function(){
            return view('aluno.perfil');
        })->name('aluno.perfil');

        Route::get('/perfil/change-password', [App\Http\Controllers\PerfilController::class, 'changePasswordAluno'])->name('aluno.change-password');
        Route::post('/perfil/change-password', [App\Http\Controllers\PerfilController::class, 'updatePasswordAluno'])->name('aluno.update-password');

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

        Route::get('/home', [App\Http\Controllers\HomeController::class, 'adminHome'])->name('admin.home');



        // Cadastro de aluno

        Route::get('/alunos', [App\Http\Controllers\UsuariosController::class, 'index'])->name('alunos.index');
        Route::get('/alunos/create', [App\Http\Controllers\UsuariosController::class, 'createAluno'])->name('alunos.create');
        Route::post('/alunos/store', [App\Http\Controllers\UsuariosController::class, 'storeAluno'])->name('alunos.store');
        Route::post('/alunos/ativar/{aluno}', [App\Http\Controllers\UsuariosController::class, 'ativarAluno'])->name('alunos.ativar');
        Route::get('/alunos/{aluno}', [App\Http\Controllers\UsuariosController::class, 'showAluno'])->name('alunos.show');
        Route::get('/alunos/{aluno}/edit',[App\Http\Controllers\UsuariosController::class, 'editAluno'])->name('alunos.edit');
        Route::put('/alunos/{aluno}', [App\Http\Controllers\UsuariosController::class, 'updateAluno'])->name('alunos.update');
        Route::delete('/alunos/{aluno}', [App\Http\Controllers\UsuariosController::class, 'destroyAluno'])->name('alunos.destroy');
        Route::delete('/alunos/inativar/{aluno}', [App\Http\Controllers\UsuariosController::class, 'inativarAluno'])->name('alunos.inativar');

        // Cadastro de professores

        Route::get('/personals', [App\Http\Controllers\UsuariosController::class, 'index'])->name('personals.index');
        Route::get('/personals/create', [App\Http\Controllers\UsuariosController::class, 'createPersonal'])->name('personals.create');
        Route::post('/personals/store', [App\Http\Controllers\UsuariosController::class, 'storePersonal'])->name('personals.store');
        Route::post('/personals/ativar/{personal}', [App\Http\Controllers\UsuariosController::class, 'ativarPersonal'])->name('personals.ativar');
        Route::get('/personals/{personal}', [App\Http\Controllers\UsuariosController::class, 'showPersonal'])->name('personals.show');
        Route::get('/personals/{personal}/edit',[App\Http\Controllers\UsuariosController::class, 'editPersonal'])->name('personals.edit');
        Route::put('/personals/{personal}', [App\Http\Controllers\UsuariosController::class, 'updatePersonal'])->name('personals.update');
        Route::delete('/personals/{personal}', [App\Http\Controllers\UsuariosController::class, 'destroyPersonal'])->name('personals.destroy');
        Route::delete('/personals/inativar/{personal}', [App\Http\Controllers\UsuariosController::class, 'inativarPersonal'])->name('personals.inativar');


        // filtro de registros
        Route::any('/usuarios/search', [App\Http\Controllers\UsuariosController::class, 'search'])->name('usuarios.search');

        /* Rotas dashboard */
        Route::get('/', [App\Http\Controllers\HomeController::class, 'adminHome'])->name('admin');


        /* Perfil */
        Route::get('/perfil', function(){
            return view('admin.perfil');
        })->name('admin.perfil');

        Route::get('/perfil/change-password', [App\Http\Controllers\PerfilController::class, 'changePasswordAdmin'])->name('admin.change-password');
        Route::post('/perfil/change-password', [App\Http\Controllers\PerfilController::class, 'updatePasswordAdmin'])->name('admin.update-password');

        /* Usuarios */
        Route::get('/usuarios', [App\Http\Controllers\UsuariosController::class, 'index'])->name('admin.usuarios');

        /* Rotas para o Financeiro */
        Route::get('/financeiro', function(){
            return view('admin.financeiro');
        })->name('admin.financeiro');

        /* Rotas para os treinos */
        Route::get('/treino', function(){
            return view('admin.treino');
        })->name('admin.treino');

        // Exercicios
        Route::get('/treino/exercicios/create', [App\Http\Controllers\ExerciciosController::class, 'create'])->name('exercicios.create');
        Route::post('/treino/exercicios/store', [App\Http\Controllers\ExerciciosController::class, 'store'])->name('exercicios.store');
        Route::get('/treino/exercicios/{exercicio}', [App\Http\Controllers\ExerciciosController::class, 'show'])->name('exercicios.show');
        Route::get('/treino/exercicios/{exercicio}/edit',[App\Http\Controllers\ExerciciosController::class, 'edit'])->name('exercicios.edit');
        Route::put('/treino/exercicios/{exercicio}', [App\Http\Controllers\ExerciciosController::class, 'update'])->name('exercicios.update');
        Route::delete('/treino/exercicios/{exercicio}', [App\Http\Controllers\ExerciciosController::class, 'destroy'])->name('exercicios.destroy');
        
});
});


/*------------------------------------------
--------------------------------------------
lISTA DE ROTAS DE PROFESSOR
--------------------------------------------
--------------------------------------------*/
Route::middleware(['auth', 'user-access:professor'])->group(function () {

    Route::prefix('professor')->group(function(){

        Route::get('/home', [App\Http\Controllers\HomeController::class, 'professorHome'])->name('professor.home');

         /* Rotas dashboard */
         Route::get('/', function(){
            return view('professor.dashboard');
        })->name('professor');

        /* Perfil */
        Route::get('/perfil', function(){
            return view('professor.perfil');
        })->name('professor.perfil');

        Route::get('/perfil/change-password', [App\Http\Controllers\PerfilController::class, 'changePasswordProfessor'])->name('professor.change-password');
        Route::post('/perfil/change-password', [App\Http\Controllers\PerfilController::class, 'updatePasswordProfessor'])->name('professor.update-password');

        /* Rotas para os treinos */
        Route::get('/treino', function(){
            return view('professor.treino');
        })->name('professor.treino');

    });

});

Route::fallback(function () {
    return view('fallback');
});
