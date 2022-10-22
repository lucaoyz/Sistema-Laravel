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
        Route::get('/perfil', [App\Http\Controllers\PerfilController::class, 'perfilIndexAluno'])->name('aluno.perfil');

        Route::get('/perfil/change-password', [App\Http\Controllers\PerfilController::class, 'changePasswordAluno'])->name('aluno.change-password');
        Route::post('/perfil/change-password', [App\Http\Controllers\PerfilController::class, 'updatePasswordAluno'])->name('aluno.update-password');

        /* Rotas para os treinos */
        Route::get('/treino', [App\Http\Controllers\TreinoController::class, 'indexAluno'])->name('aluno.treino');
        Route::get('/treino/visualizar', [App\Http\Controllers\TreinoController::class, 'visualizarTreinoAluno'])->name('aluno.treino.visualizar');

        /* Rotas para imprimir o treino */
        Route::get('/treino/imprimir', [App\Http\Controllers\TreinoController::class, 'ImprimirTreino'])->name('aluno.ImprimirTreino');
        Route::get('/treino/imprimir/divisoes', [App\Http\Controllers\TreinoController::class, 'ImprimirTreinoDivisoes'])->name('aluno.ImprimirTreinoDivisoes');
        Route::get('/treino/imprimir/divisoes/a', [App\Http\Controllers\TreinoController::class, 'ImprimirTreinoDivisoesA'])->name('aluno.ImprimirTreinoDivisoesA');
        Route::get('/treino/imprimir/divisoes/b', [App\Http\Controllers\TreinoController::class, 'ImprimirTreinoDivisoesB'])->name('aluno.ImprimirTreinoDivisoesB');
        Route::get('/treino/imprimir/divisoes/c', [App\Http\Controllers\TreinoController::class, 'ImprimirTreinoDivisoesC'])->name('aluno.ImprimirTreinoDivisoesC');                Route::get('/treino/pdf/divisoes/d', [App\Http\Controllers\TreinoController::class, 'PDFTreinoDivisoesD'])->name('aluno.PDFTreinoDivisoesD');
        Route::get('/treino/imprimir/divisoes/e', [App\Http\Controllers\TreinoController::class, 'ImprimirTreinoDivisoesE'])->name('aluno.ImprimirTreinoDivisoesE');
        Route::get('/treino/imprimir/divisoes/f', [App\Http\Controllers\TreinoController::class, 'ImprimirTreinoDivisoesF'])->name('aluno.ImprimirTreinoDivisoesF');

        /* Rotas para baixar o treino */
        Route::get('/treino/pdf/divisoes', [App\Http\Controllers\TreinoController::class, 'PDFTreinoDivisoes'])->name('aluno.PDFTreinoDivisoes');
        Route::get('/treino/pdf/divisoes/a', [App\Http\Controllers\TreinoController::class, 'PDFTreinoDivisoesA'])->name('aluno.PDFTreinoDivisoesA');
        Route::get('/treino/pdf/divisoes/b', [App\Http\Controllers\TreinoController::class, 'PDFTreinoDivisoesB'])->name('aluno.PDFTreinoDivisoesB');
        Route::get('/treino/pdf/divisoes/c', [App\Http\Controllers\TreinoController::class, 'PDFTreinoDivisoesC'])->name('aluno.PDFTreinoDivisoesC');
        Route::get('/treino/pdf/divisoes/d', [App\Http\Controllers\TreinoController::class, 'PDFTreinoDivisoesD'])->name('aluno.PDFTreinoDivisoesD');
        Route::get('/treino/pdf/divisoes/e', [App\Http\Controllers\TreinoController::class, 'PDFTreinoDivisoesE'])->name('aluno.PDFTreinoDivisoesE');
        Route::get('/treino/pdf/divisoes/f', [App\Http\Controllers\TreinoController::class, 'PDFTreinoDivisoesF'])->name('aluno.PDFTreinoDivisoesF');

        /* Rotas para histórico de treino */
        Route::get('/treino/concluir/a', [App\Http\Controllers\TreinoController::class, 'conclusaoTreinoA'])->name('aluno.conclusaoTreinoA');
        Route::get('/treino/concluir/b', [App\Http\Controllers\TreinoController::class, 'conclusaoTreinoB'])->name('aluno.conclusaoTreinoB');
        Route::get('/treino/concluir/c', [App\Http\Controllers\TreinoController::class, 'conclusaoTreinoC'])->name('aluno.conclusaoTreinoC');
        Route::get('/treino/concluir/d', [App\Http\Controllers\TreinoController::class, 'conclusaoTreinoD'])->name('aluno.conclusaoTreinoD');
        Route::get('/treino/concluir/e', [App\Http\Controllers\TreinoController::class, 'conclusaoTreinoE'])->name('aluno.conclusaoTreinoE');
        Route::get('/treino/concluir/f', [App\Http\Controllers\TreinoController::class, 'conclusaoTreinoF'])->name('aluno.conclusaoTreinoF');
        Route::get('/treino/limparHistorico', [App\Http\Controllers\TreinoController::class, 'limparHistorico'])->name('aluno.limparHistorico');

        /* Rotas para as divisões do treino */
        Route::get('/treino/visualizar/a', [App\Http\Controllers\TreinoController::class, 'visualizarTreinoAAluno'])->name('aluno.treino.visualizar.a');
        Route::get('/treino/visualizar/b', [App\Http\Controllers\TreinoController::class, 'visualizarTreinoBAluno'])->name('aluno.treino.visualizar.b');
        Route::get('/treino/visualizar/c', [App\Http\Controllers\TreinoController::class, 'visualizarTreinoCAluno'])->name('aluno.treino.visualizar.c');
        Route::get('/treino/visualizar/d', [App\Http\Controllers\TreinoController::class, 'visualizarTreinoDAluno'])->name('aluno.treino.visualizar.d');
        Route::get('/treino/visualizar/e', [App\Http\Controllers\TreinoController::class, 'visualizarTreinoEAluno'])->name('aluno.treino.visualizar.e');
        Route::get('/treino/visualizar/f', [App\Http\Controllers\TreinoController::class, 'visualizarTreinoFAluno'])->name('aluno.treino.visualizar.f');

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
        Route::get('/alunos/avaliacao/{aluno}', [App\Http\Controllers\UsuariosController::class, 'avaliacaoFisica'])->name('alunos.avaliacaoFisica');
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

        /* Rotas alterar site e informações */
        Route::get('/informacoes', [App\Http\Controllers\InformacoesController::class, 'index'])->name('admin.alterarInfos');
        Route::get('/informacoes/planos/create', [App\Http\Controllers\InformacoesController::class, 'createPlanos'])->name('admin.alterarInfos.createPlanos');
        Route::post('/informacoes/planos/store', [App\Http\Controllers\InformacoesController::class, 'storePlanos'])->name('admin.alterarInfos.storePlanos');
        Route::get('/informacoes/planos/edit', [App\Http\Controllers\InformacoesController::class, 'editPlanos'])->name('admin.alterarInfos.editPlanos');
        Route::put('/informacoes/planos/update', [App\Http\Controllers\InformacoesController::class, 'updatePlanos'])->name('admin.alterarInfos.updatePlanos');
        Route::delete('/informacoes/planos/delete', [App\Http\Controllers\InformacoesController::class, 'deletePlanos'])->name('admin.alterarInfos.deletePlanos');

        /* Perfil */
        Route::get('/perfil', [App\Http\Controllers\PerfilController::class, 'perfilIndexAdmin'])->name('admin.perfil');

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
            Route::delete('/treino/geral/limpar/{treinoGeral}', [App\Http\Controllers\TreinoController::class, 'limparGeral'])->name('treinos.limparGeral');
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
            Route::post('/treino/detalhes/{treinoGeral}/b', [App\Http\Controllers\TreinoController::class, 'storeDetalhesDivisaoB'])->name('treinos.storeDetalhesDivisaoB');
            Route::get('/treino/detalhes/{treinoGeral}/b/edit', [App\Http\Controllers\TreinoController::class, 'editDetalhesDivisaoB'])->name('treinos.editDetalhesDivisaoB');
            Route::put('/treino/detalhes/{treinoGeral}/b', [App\Http\Controllers\TreinoController::class, 'updateDetalhesDivisaoB'])->name('treinos.updateDetalhesDivisaoB');
            Route::delete('/treino/detalhes/{treinoGeral}/{treinoDetalhe}/b', [App\Http\Controllers\TreinoController::class, 'destroyDetalhesDivisaoB'])->name('treinos.destroyDetalhesDivisaoB');
            Route::any('/treino/detalhes/{treinoGeral}/b/search', [App\Http\Controllers\TreinoController::class, 'searchDetalhesDivisaoB'])->name('treinos.searchDetalhesDivisaoB');

            Route::get('/treino/detalhes/{treinoGeral}/c', [App\Http\Controllers\TreinoController::class, 'createDetalhesDivisaoC'])->name('treinos.createDetalhesDivisaoC');
            Route::post('/treino/detalhes/{treinoGeral}/c', [App\Http\Controllers\TreinoController::class, 'storeDetalhesDivisaoC'])->name('treinos.storeDetalhesDivisaoC');
            Route::get('/treino/detalhes/{treinoGeral}/c/edit', [App\Http\Controllers\TreinoController::class, 'editDetalhesDivisaoC'])->name('treinos.editDetalhesDivisaoC');
            Route::put('/treino/detalhes/{treinoGeral}/c', [App\Http\Controllers\TreinoController::class, 'updateDetalhesDivisaoC'])->name('treinos.updateDetalhesDivisaoC');
            Route::delete('/treino/detalhes/{treinoGeral}/{treinoDetalhe}/c', [App\Http\Controllers\TreinoController::class, 'destroyDetalhesDivisaoC'])->name('treinos.destroyDetalhesDivisaoC');
            Route::any('/treino/detalhes/{treinoGeral}/c/search', [App\Http\Controllers\TreinoController::class, 'searchDetalhesDivisaoC'])->name('treinos.searchDetalhesDivisaoC');

            Route::get('/treino/detalhes/{treinoGeral}/d', [App\Http\Controllers\TreinoController::class, 'createDetalhesDivisaoD'])->name('treinos.createDetalhesDivisaoD');
            Route::post('/treino/detalhes/{treinoGeral}/d', [App\Http\Controllers\TreinoController::class, 'storeDetalhesDivisaoD'])->name('treinos.storeDetalhesDivisaoD');
            Route::get('/treino/detalhes/{treinoGeral}/d/edit', [App\Http\Controllers\TreinoController::class, 'editDetalhesDivisaoD'])->name('treinos.editDetalhesDivisaoD');
            Route::put('/treino/detalhes/{treinoGeral}/d', [App\Http\Controllers\TreinoController::class, 'updateDetalhesDivisaoD'])->name('treinos.updateDetalhesDivisaoD');
            Route::delete('/treino/detalhes/{treinoGeral}/{treinoDetalhe}/d', [App\Http\Controllers\TreinoController::class, 'destroyDetalhesDivisaoD'])->name('treinos.destroyDetalhesDivisaoD');
            Route::any('/treino/detalhes/{treinoGeral}/d/search', [App\Http\Controllers\TreinoController::class, 'searchDetalhesDivisaoD'])->name('treinos.searchDetalhesDivisaoD');

            Route::get('/treino/detalhes/{treinoGeral}/e', [App\Http\Controllers\TreinoController::class, 'createDetalhesDivisaoE'])->name('treinos.createDetalhesDivisaoE');
            Route::post('/treino/detalhes/{treinoGeral}/e', [App\Http\Controllers\TreinoController::class, 'storeDetalhesDivisaoE'])->name('treinos.storeDetalhesDivisaoE');
            Route::get('/treino/detalhes/{treinoGeral}/e/edit', [App\Http\Controllers\TreinoController::class, 'editDetalhesDivisaoE'])->name('treinos.editDetalhesDivisaoE');
            Route::put('/treino/detalhes/{treinoGeral}/e', [App\Http\Controllers\TreinoController::class, 'updateDetalhesDivisaoE'])->name('treinos.updateDetalhesDivisaoE');
            Route::delete('/treino/detalhes/{treinoGeral}/{treinoDetalhe}/e', [App\Http\Controllers\TreinoController::class, 'destroyDetalhesDivisaoE'])->name('treinos.destroyDetalhesDivisaoE');
            Route::any('/treino/detalhes/{treinoGeral}/e/search', [App\Http\Controllers\TreinoController::class, 'searchDetalhesDivisaoE'])->name('treinos.searchDetalhesDivisaoE');

            Route::get('/treino/detalhes/{treinoGeral}/f', [App\Http\Controllers\TreinoController::class, 'createDetalhesDivisaoF'])->name('treinos.createDetalhesDivisaoF');
            Route::post('/treino/detalhes/{treinoGeral}/f', [App\Http\Controllers\TreinoController::class, 'storeDetalhesDivisaoF'])->name('treinos.storeDetalhesDivisaoF');
            Route::get('/treino/detalhes/{treinoGeral}/f/edit', [App\Http\Controllers\TreinoController::class, 'editDetalhesDivisaoF'])->name('treinos.editDetalhesDivisaoF');
            Route::put('/treino/detalhes/{treinoGeral}/f', [App\Http\Controllers\TreinoController::class, 'updateDetalhesDivisaoF'])->name('treinos.updateDetalhesDivisaoF');
            Route::delete('/treino/detalhes/{treinoGeral}/{treinoDetalhe}/f', [App\Http\Controllers\TreinoController::class, 'destroyDetalhesDivisaoF'])->name('treinos.destroyDetalhesDivisaoF');
            Route::any('/treino/detalhes/{treinoGeral}/f/search', [App\Http\Controllers\TreinoController::class, 'searchDetalhesDivisaoF'])->name('treinos.searchDetalhesDivisaoF');

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

        /* Rotas para visualização de aluno */
        Route::get('/treino/pdf/divisoes/a{treinoGeral}', [App\Http\Controllers\TreinoController::class, 'PDFTreinoDivisoesATreinador'])->name('aluno.PDFTreinoDivisoesATreinador');
        Route::get('/treino/pdf/divisoes/b{treinoGeral}', [App\Http\Controllers\TreinoController::class, 'PDFTreinoDivisoesBTreinador'])->name('aluno.PDFTreinoDivisoesBTreinador');
        Route::get('/treino/pdf/divisoes/c{treinoGeral}', [App\Http\Controllers\TreinoController::class, 'PDFTreinoDivisoesCTreinador'])->name('aluno.PDFTreinoDivisoesCTreinador');
        Route::get('/treino/pdf/divisoes/d{treinoGeral}', [App\Http\Controllers\TreinoController::class, 'PDFTreinoDivisoesDTreinador'])->name('aluno.PDFTreinoDivisoesDTreinador');
        Route::get('/treino/pdf/divisoes/e{treinoGeral}', [App\Http\Controllers\TreinoController::class, 'PDFTreinoDivisoesETreinador'])->name('aluno.PDFTreinoDivisoesETreinador');
        Route::get('/treino/pdf/divisoes/f{treinoGeral}', [App\Http\Controllers\TreinoController::class, 'PDFTreinoDivisoesFTreinador'])->name('aluno.PDFTreinoDivisoesFTreinador');

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
        Route::get('/perfil', [App\Http\Controllers\PerfilController::class, 'perfilIndexProfessor'])->name('professor.perfil');

        Route::get('/perfil/change-password', [App\Http\Controllers\PerfilController::class, 'changePasswordProfessor'])->name('professor.change-password');
        Route::post('/perfil/change-password', [App\Http\Controllers\PerfilController::class, 'updatePasswordProfessor'])->name('professor.update-password');

        /* Rotas para os treinos */
        Route::get('/treino', [App\Http\Controllers\ProfessorTreinoController::class, 'indexProfessor'])->name('professor.treinos.index');

            /* Rotas para informações gerais do treino */
            Route::get('/treino/geral', [App\Http\Controllers\ProfessorTreinoController::class, 'indexGeral'])->name('professor.treinos.indexGeral');
            Route::get('/treino/geral/create', [App\Http\Controllers\ProfessorTreinoController::class, 'createGeral'])->name('professor.treinos.createGeral');
            Route::post('/treino/geral/store', [App\Http\Controllers\ProfessorTreinoController::class, 'storeGeral'])->name('professor.treinos.storeGeral');
            Route::get('/treino/geral/{treinoGeral}', [App\Http\Controllers\ProfessorTreinoController::class, 'showGeral'])->name('professor.treinos.showGeral');
            Route::get('/treino/geral/{treinoGeral}/edit',[App\Http\Controllers\ProfessorTreinoController::class, 'editGeral'])->name('professor.treinos.editGeral');
            Route::put('/treino/geral/{treinoGeral}', [App\Http\Controllers\ProfessorTreinoController::class, 'updateGeral'])->name('professor.treinos.updateGeral');
            Route::delete('/treino/geral/{treinoGeral}', [App\Http\Controllers\ProfessorTreinoController::class, 'destroyGeral'])->name('professor.treinos.destroyGeral');
            Route::delete('/treino/geral/limpar/{treinoGeral}', [App\Http\Controllers\ProfessorTreinoController::class, 'limparGeral'])->name('professor.treinos.limparGeral');
            Route::any('/treino/geral/search', [App\Http\Controllers\ProfessorTreinoController::class, 'searchGeral'])->name('professor.treinos.searchGeral');

            /* Rotas para detalhes do treino */
            Route::get('/treino/detalhes/{treinoGeral}', [App\Http\Controllers\ProfessorTreinoController::class, 'indexDetalhes'])->name('professor.treinos.indexDetalhes');

            /* Rotas para as divisões do treino */
            Route::get('/treino/detalhes/{treinoGeral}/a', [App\Http\Controllers\ProfessorTreinoController::class, 'createDetalhesDivisaoA'])->name('professor.treinos.createDetalhesDivisaoA');
            Route::post('/treino/detalhes/{treinoGeral}/a', [App\Http\Controllers\ProfessorTreinoController::class, 'storeDetalhesDivisaoA'])->name('professor.treinos.storeDetalhesDivisaoA');
            Route::get('/treino/detalhes/{treinoGeral}/a/edit', [App\Http\Controllers\ProfessorTreinoController::class, 'editDetalhesDivisaoA'])->name('professor.treinos.editDetalhesDivisaoA');
            Route::put('/treino/detalhes/{treinoGeral}/a', [App\Http\Controllers\ProfessorTreinoController::class, 'updateDetalhesDivisaoA'])->name('professor.treinos.updateDetalhesDivisaoA');
            Route::delete('/treino/detalhes/{treinoGeral}/{treinoDetalhe}/a', [App\Http\Controllers\ProfessorTreinoController::class, 'destroyDetalhesDivisaoA'])->name('professor.treinos.destroyDetalhesDivisaoA');
            Route::any('/treino/detalhes/{treinoGeral}/a/search', [App\Http\Controllers\ProfessorTreinoController::class, 'searchDetalhesDivisaoA'])->name('professor.treinos.searchDetalhesDivisaoA');

            Route::get('/treino/detalhes/{treinoGeral}/b', [App\Http\Controllers\ProfessorTreinoController::class, 'createDetalhesDivisaoB'])->name('professor.treinos.createDetalhesDivisaoB');
            Route::post('/treino/detalhes/{treinoGeral}/b', [App\Http\Controllers\ProfessorTreinoController::class, 'storeDetalhesDivisaoB'])->name('professor.treinos.storeDetalhesDivisaoB');
            Route::get('/treino/detalhes/{treinoGeral}/b/edit', [App\Http\Controllers\ProfessorTreinoController::class, 'editDetalhesDivisaoB'])->name('professor.treinos.editDetalhesDivisaoB');
            Route::put('/treino/detalhes/{treinoGeral}/b', [App\Http\Controllers\ProfessorTreinoController::class, 'updateDetalhesDivisaoB'])->name('professor.treinos.updateDetalhesDivisaoB');
            Route::delete('/treino/detalhes/{treinoGeral}/{treinoDetalhe}/b', [App\Http\Controllers\ProfessorTreinoController::class, 'destroyDetalhesDivisaoB'])->name('professor.treinos.destroyDetalhesDivisaoB');
            Route::any('/treino/detalhes/{treinoGeral}/b/search', [App\Http\Controllers\ProfessorTreinoController::class, 'searchDetalhesDivisaoB'])->name('professor.treinos.searchDetalhesDivisaoB');

            Route::get('/treino/detalhes/{treinoGeral}/c', [App\Http\Controllers\ProfessorTreinoController::class, 'createDetalhesDivisaoC'])->name('professor.treinos.createDetalhesDivisaoC');
            Route::post('/treino/detalhes/{treinoGeral}/c', [App\Http\Controllers\ProfessorTreinoController::class, 'storeDetalhesDivisaoC'])->name('professor.treinos.storeDetalhesDivisaoC');
            Route::get('/treino/detalhes/{treinoGeral}/c/edit', [App\Http\Controllers\ProfessorTreinoController::class, 'editDetalhesDivisaoC'])->name('professor.treinos.editDetalhesDivisaoC');
            Route::put('/treino/detalhes/{treinoGeral}/c', [App\Http\Controllers\ProfessorTreinoController::class, 'updateDetalhesDivisaoC'])->name('professor.treinos.updateDetalhesDivisaoC');
            Route::delete('/treino/detalhes/{treinoGeral}/{treinoDetalhe}/c', [App\Http\Controllers\ProfessorTreinoController::class, 'destroyDetalhesDivisaoC'])->name('professor.treinos.destroyDetalhesDivisaoC');
            Route::any('/treino/detalhes/{treinoGeral}/c/search', [App\Http\Controllers\ProfessorTreinoController::class, 'searchDetalhesDivisaoC'])->name('professor.treinos.searchDetalhesDivisaoC');

            Route::get('/treino/detalhes/{treinoGeral}/d', [App\Http\Controllers\ProfessorTreinoController::class, 'createDetalhesDivisaoD'])->name('professor.treinos.createDetalhesDivisaoD');
            Route::post('/treino/detalhes/{treinoGeral}/d', [App\Http\Controllers\ProfessorTreinoController::class, 'storeDetalhesDivisaoD'])->name('professor.treinos.storeDetalhesDivisaoD');
            Route::get('/treino/detalhes/{treinoGeral}/d/edit', [App\Http\Controllers\ProfessorTreinoController::class, 'editDetalhesDivisaoD'])->name('professor.treinos.editDetalhesDivisaoD');
            Route::put('/treino/detalhes/{treinoGeral}/d', [App\Http\Controllers\ProfessorTreinoController::class, 'updateDetalhesDivisaoD'])->name('professor.treinos.updateDetalhesDivisaoD');
            Route::delete('/treino/detalhes/{treinoGeral}/{treinoDetalhe}/d', [App\Http\Controllers\ProfessorTreinoController::class, 'destroyDetalhesDivisaoD'])->name('professor.treinos.destroyDetalhesDivisaoD');
            Route::any('/treino/detalhes/{treinoGeral}/d/search', [App\Http\Controllers\ProfessorTreinoController::class, 'searchDetalhesDivisaoD'])->name('professor.treinos.searchDetalhesDivisaoD');

            Route::get('/treino/detalhes/{treinoGeral}/e', [App\Http\Controllers\ProfessorTreinoController::class, 'createDetalhesDivisaoE'])->name('professor.treinos.createDetalhesDivisaoE');
            Route::post('/treino/detalhes/{treinoGeral}/e', [App\Http\Controllers\ProfessorTreinoController::class, 'storeDetalhesDivisaoE'])->name('professor.treinos.storeDetalhesDivisaoE');
            Route::get('/treino/detalhes/{treinoGeral}/e/edit', [App\Http\Controllers\ProfessorTreinoController::class, 'editDetalhesDivisaoE'])->name('professor.treinos.editDetalhesDivisaoE');
            Route::put('/treino/detalhes/{treinoGeral}/e', [App\Http\Controllers\ProfessorTreinoController::class, 'updateDetalhesDivisaoE'])->name('professor.treinos.updateDetalhesDivisaoE');
            Route::delete('/treino/detalhes/{treinoGeral}/{treinoDetalhe}/e', [App\Http\Controllers\ProfessorTreinoController::class, 'destroyDetalhesDivisaoE'])->name('professor.treinos.destroyDetalhesDivisaoE');
            Route::any('/treino/detalhes/{treinoGeral}/e/search', [App\Http\Controllers\ProfessorTreinoController::class, 'searchDetalhesDivisaoE'])->name('professor.treinos.searchDetalhesDivisaoE');

            Route::get('/treino/detalhes/{treinoGeral}/f', [App\Http\Controllers\ProfessorTreinoController::class, 'createDetalhesDivisaoF'])->name('professor.treinos.createDetalhesDivisaoF');
            Route::post('/treino/detalhes/{treinoGeral}/f', [App\Http\Controllers\ProfessorTreinoController::class, 'storeDetalhesDivisaoF'])->name('professor.treinos.storeDetalhesDivisaoF');
            Route::get('/treino/detalhes/{treinoGeral}/f/edit', [App\Http\Controllers\ProfessorTreinoController::class, 'editDetalhesDivisaoF'])->name('professor.treinos.editDetalhesDivisaoF');
            Route::put('/treino/detalhes/{treinoGeral}/f', [App\Http\Controllers\ProfessorTreinoController::class, 'updateDetalhesDivisaoF'])->name('professor.treinos.updateDetalhesDivisaoF');
            Route::delete('/treino/detalhes/{treinoGeral}/{treinoDetalhe}/f', [App\Http\Controllers\ProfessorTreinoController::class, 'destroyDetalhesDivisaoF'])->name('professor.treinos.destroyDetalhesDivisaoF');
            Route::any('/treino/detalhes/{treinoGeral}/f/search', [App\Http\Controllers\ProfessorTreinoController::class, 'searchDetalhesDivisaoF'])->name('professor.treinos.searchDetalhesDivisaoF');

        /* Rotas para os exercicios */
        Route::get('/treino/exercicios/inicio', [App\Http\Controllers\ProfessorExerciciosController::class, 'index'])->name('professor.exercicios.index');
        Route::get('/treino/exercicios/create', [App\Http\Controllers\ProfessorExerciciosController::class, 'create'])->name('professor.exercicios.create');
        Route::post('/treino/exercicios/store', [App\Http\Controllers\ProfessorExerciciosController::class, 'store'])->name('professor.exercicios.store');
        Route::get('/treino/exercicios/{exercicio}', [App\Http\Controllers\ProfessorExerciciosController::class, 'show'])->name('professor.exercicios.show');
        Route::get('/treino/exercicios/{exercicio}/edit',[App\Http\Controllers\ProfessorExerciciosController::class, 'edit'])->name('professor.exercicios.edit');
        Route::put('/treino/exercicios/{exercicio}', [App\Http\Controllers\ProfessorExerciciosController::class, 'update'])->name('professor.exercicios.update');
        Route::delete('/treino/exercicios/{exercicio}', [App\Http\Controllers\ProfessorExerciciosController::class, 'destroy'])->name('professor.exercicios.destroy');
        Route::any('/treino/exercicios/search', [App\Http\Controllers\ProfessorExerciciosController::class, 'search'])->name('professor.exercicios.search');

        /* Rotas para os equipamentos */
        Route::get('/treino/equipamentos/inicio', [App\Http\Controllers\ProfessorEquipamentosController::class, 'index'])->name('professor.equipamentos.index');
        Route::get('/treino/equipamentos/create', [App\Http\Controllers\ProfessorEquipamentosController::class, 'create'])->name('professor.equipamentos.create');
        Route::post('/treino/equipamentos/store', [App\Http\Controllers\ProfessorEquipamentosController::class, 'store'])->name('professor.equipamentos.store');
        Route::get('/treino/equipamentos/{equipamento}', [App\Http\Controllers\ProfessorEquipamentosController::class, 'show'])->name('professor.equipamentos.show');
        Route::get('/treino/equipamentos/{equipamento}/edit',[App\Http\Controllers\ProfessorEquipamentosController::class, 'edit'])->name('professor.equipamentos.edit');
        Route::put('/treino/equipamentos/{equipamento}', [App\Http\Controllers\ProfessorEquipamentosController::class, 'update'])->name('professor.equipamentos.update');
        Route::delete('/treino/equipamentos/{equipamento}', [App\Http\Controllers\ProfessorEquipamentosController::class, 'destroy'])->name('professor.equipamentos.destroy');
        Route::any('/treino/equipamentos/search', [App\Http\Controllers\ProfessorEquipamentosController::class, 'search'])->name('professor.equipamentos.search');

        /* Rotas para visualização de aluno */
        Route::get('/treino/pdf/divisoes/a{treinoGeral}', [App\Http\Controllers\ProfessorTreinoController::class, 'PDFTreinoDivisoesATreinador'])->name('professor.aluno.PDFTreinoDivisoesATreinador');
        Route::get('/treino/pdf/divisoes/b{treinoGeral}', [App\Http\Controllers\ProfessorTreinoController::class, 'PDFTreinoDivisoesBTreinador'])->name('professor.aluno.PDFTreinoDivisoesBTreinador');
        Route::get('/treino/pdf/divisoes/c{treinoGeral}', [App\Http\Controllers\ProfessorTreinoController::class, 'PDFTreinoDivisoesCTreinador'])->name('professor.aluno.PDFTreinoDivisoesCTreinador');
        Route::get('/treino/pdf/divisoes/d{treinoGeral}', [App\Http\Controllers\ProfessorTreinoController::class, 'PDFTreinoDivisoesDTreinador'])->name('professor.aluno.PDFTreinoDivisoesDTreinador');
        Route::get('/treino/pdf/divisoes/e{treinoGeral}', [App\Http\Controllers\ProfessorTreinoController::class, 'PDFTreinoDivisoesETreinador'])->name('professor.aluno.PDFTreinoDivisoesETreinador');
        Route::get('/treino/pdf/divisoes/f{treinoGeral}', [App\Http\Controllers\ProfessorTreinoController::class, 'PDFTreinoDivisoesFTreinador'])->name('professor.aluno.PDFTreinoDivisoesFTreinador');

    });

});

Route::fallback(function () {
    return view('fallback');
});
