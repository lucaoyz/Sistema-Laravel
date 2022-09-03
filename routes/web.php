<?php

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
        Route::get('/treino', [App\Http\Controllers\TreinoController::class, 'index'])->name('treinos.index');

            /* Rotas para informações gerais do treino */
            Route::get('/treino/geral', [App\Http\Controllers\TreinoController::class, 'indexGeral'])->name('treinos.indexGeral');
            Route::get('/treino/geral/create', [App\Http\Controllers\TreinoController::class, 'createGeral'])->name('treinos.createGeral');
            Route::post('/treino/geral/store', [App\Http\Controllers\TreinoController::class, 'storeGeral'])->name('treinos.storeGeral');
            Route::get('/treino/geral/{treinoGeral}', [App\Http\Controllers\TreinoController::class, 'showGeral'])->name('treinos.showGeral');
            Route::get('/treino/geral/{treinoGeral}/edit',[App\Http\Controllers\TreinoController::class, 'editGeral'])->name('treinos.editGeral');
            Route::put('/treino/geral/{treinoGeral}', [App\Http\Controllers\TreinoController::class, 'updateGeral'])->name('treinos.updateGeral');
            Route::delete('/treino/geral/{treinoGeral}', [App\Http\Controllers\TreinoController::class, 'destroyGeral'])->name('treinos.destroyGeral');
            Route::any('/treino/geral/search', [App\Http\Controllers\TreinoController::class, 'searchGeral'])->name('treinos.searchGeral');

            /* Rotas para detalhes do treino */
            Route::get('/treino/detalhes/{treinoGeral}', [App\Http\Controllers\TreinoController::class, 'indexDetalhes'])->name('treinos.indexDetalhes');

            /* Rotas para as divisões do treino */
            Route::get('/treino/detalhes/{treinoGeral}/a', [App\Http\Controllers\TreinoController::class, 'createDetalhesDivisaoA'])->name('treinos.createDetalhesDivisaoA');
            Route::post('/treino/detalhes/{treinoGeral}/a', [App\Http\Controllers\TreinoController::class, 'storeDetalhesDivisaoA'])->name('treinos.storeDetalhesDivisaoA');
            Route::get('/treino/detalhes/{treinoGeral}/a/edit', [App\Http\Controllers\TreinoController::class, 'editDetalhesDivisaoA'])->name('treinos.editDetalhesDivisaoA');
            Route::put('/treino/detalhes/{treinoGeral}/a', [App\Http\Controllers\TreinoController::class, 'updateDetalhesDivisaoA'])->name('treinos.updateDetalhesDivisaoA');
            Route::delete('/treino/detalhes/{treinoGeral}/{treinoDetalhe}/a', [App\Http\Controllers\TreinoController::class, 'destroyDetalhesDivisaoA'])->name('treinos.destroyDetalhesDivisaoA');
            Route::any('/treino/detalhes/{treinoGeral}/a/search', [App\Http\Controllers\TreinoController::class, 'searchDetalhesDivisaoA'])->name('treinos.searchDetalhesDivisaoA');

            Route::get('/treino/detalhes/{treinoGeral}/b', [App\Http\Controllers\TreinoController::class, 'createDetalhesDivisaoB'])->name('treinos.createDetalhesDivisaoB');
            Route::get('/treino/detalhes/{treinoGeral}/c', [App\Http\Controllers\TreinoController::class, 'createDetalhesDivisaoC'])->name('treinos.createDetalhesDivisaoC');
            Route::get('/treino/detalhes/{treinoGeral}/d', [App\Http\Controllers\TreinoController::class, 'createDetalhesDivisaoD'])->name('treinos.createDetalhesDivisaoD');
            Route::get('/treino/detalhes/{treinoGeral}/e', [App\Http\Controllers\TreinoController::class, 'createDetalhesDivisaoE'])->name('treinos.createDetalhesDivisaoE');
            Route::get('/treino/detalhes/{treinoGeral}/f', [App\Http\Controllers\TreinoController::class, 'createDetalhesDivisaoF'])->name('treinos.createDetalhesDivisaoF');

        /* Rotas para os exercicios */
        Route::get('/treino/exercicios/inicio', [App\Http\Controllers\ExerciciosController::class, 'index'])->name('exercicios.index');
        Route::get('/treino/exercicios/create', [App\Http\Controllers\ExerciciosController::class, 'create'])->name('exercicios.create');
        Route::post('/treino/exercicios/store', [App\Http\Controllers\ExerciciosController::class, 'store'])->name('exercicios.store');
        Route::get('/treino/exercicios/{exercicio}', [App\Http\Controllers\ExerciciosController::class, 'show'])->name('exercicios.show');
        Route::get('/treino/exercicios/{exercicio}/edit',[App\Http\Controllers\ExerciciosController::class, 'edit'])->name('exercicios.edit');
        Route::put('/treino/exercicios/{exercicio}', [App\Http\Controllers\ExerciciosController::class, 'update'])->name('exercicios.update');
        Route::delete('/treino/exercicios/{exercicio}', [App\Http\Controllers\ExerciciosController::class, 'destroy'])->name('exercicios.destroy');
        Route::any('/treino/exercicios/search', [App\Http\Controllers\ExerciciosController::class, 'search'])->name('exercicios.search');

        /* Rotas para os equipamentos */
        Route::get('/treino/equipamentos/inicio', [App\Http\Controllers\EquipamentosController::class, 'index'])->name('equipamentos.index');
        Route::get('/treino/equipamentos/create', [App\Http\Controllers\EquipamentosController::class, 'create'])->name('equipamentos.create');
        Route::post('/treino/equipamentos/store', [App\Http\Controllers\EquipamentosController::class, 'store'])->name('equipamentos.store');
        Route::get('/treino/equipamentos/{equipamento}', [App\Http\Controllers\EquipamentosController::class, 'show'])->name('equipamentos.show');
        Route::get('/treino/equipamentos/{equipamento}/edit',[App\Http\Controllers\EquipamentosController::class, 'edit'])->name('equipamentos.edit');
        Route::put('/treino/equipamentos/{equipamento}', [App\Http\Controllers\EquipamentosController::class, 'update'])->name('equipamentos.update');
        Route::delete('/treino/equipamentos/{equipamento}', [App\Http\Controllers\EquipamentosController::class, 'destroy'])->name('equipamentos.destroy');
        Route::any('/treino/equipamentos/search', [App\Http\Controllers\EquipamentosController::class, 'search'])->name('equipamentos.search');

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
