<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Personal;
use App\Models\Aluno;
use App\Models\TreinoGeral;
use App\Models\User;
use App\Models\Plano;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class UsuariosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Aluno $aluno)
    {
        $alunos = Aluno::latest()->paginate(5);
        $alunos->alu_data_nascimento = \Carbon\Carbon::now('America/Sao_Paulo');

        $personals = Personal::latest()->paginate(5);
        $personals->per_data_nascimento = \Carbon\Carbon::now('America/Sao_Paulo');

        $plano = Plano::all()->first();
        $plano1 = Plano::select('pl_plano1')->first();
        $plano2 = Plano::select('pl_plano2')->first();
        $plano3 = Plano::select('pl_plano3')->first();
        $plano4 = Plano::select('pl_plano4')->first();

        return view('admin.usuarios', [
            'alunos' => $alunos,
            'personals' => $personals,
            'plano' => $plano,
            'plano1' => $plano1,
            'plano2' => $plano2,
            'plano3' => $plano3,
            'plano4' => $plano4,
            ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createAluno()
    {
        return view('admin.usuarios');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeAluno(Request $request)
    {
        $usuarioEmail = Aluno::where('alu_email', '=', $request->input('alu_email'))->first();
        $usuarioEmailPer = Personal::where('per_email', '=', $request->input('alu_email'))->first();

        if($usuarioEmailPer){
            return redirect()->route('admin.usuarios')
            ->with('error','Esse email já está sendo usado!');
        }
        if($usuarioEmail){
            return redirect()->route('admin.usuarios')
            ->with('error','Esse email já está sendo usado!');
        }
        else {
            try{

                $dados = $request->validate([
                    'alu_nome' => 'required',
                    'alu_email' => 'required',
                    'alu_data_nascimento' => 'required|date',
                    'alu_endereco' => 'required',
                    'alu_mensalidade' => 'required',
                    'alu_celular' => 'required',
                    'alu_cpf' => 'required|cpf',
                ]);

                $result = Aluno::create($request->all());

                $tb_user = new User;
                $tb_user->alu_id = $result->id;
                $tb_user->name = $request->alu_nome;
                $tb_user->email = $request->alu_email;
                $tb_user->password = bcrypt('12345678');
                $tb_user->type = 0;

                $result = $tb_user->save();
                return redirect()->route('admin.usuarios')
                                ->with('success','Aluno criado com sucesso!');
            } catch (\Illuminate\Validation\ValidationException $e) {
                return redirect()->route('admin.usuarios')
            ->with('error', 'O Cpf é inválido.');
            }
            }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Aluno  $aluno
     * @return \Illuminate\Http\Response
     */

    public function ativarAluno(Aluno $aluno)
    {
        $usuario = User::where('email', '=', $aluno->alu_email)->first();

        if(empty($usuario)){
            $alu_id = $aluno->id;
            $alu_email = $aluno->alu_email;
            $alu_nome = $aluno->alu_nome;

            $tb_user = new User;
            $tb_user->alu_id = $alu_id;
            $tb_user->name = $alu_nome;
            $tb_user->email = $alu_email;
            $tb_user->password = bcrypt('12345678');
            $tb_user->type = 0;
            $tb_user->save();

            return redirect()->route('admin.usuarios')
                            ->with('success','Aluno ativado com sucesso!');
        } else {
            return redirect()->route('admin.usuarios')
            ->with('error','Aluno já está ativado!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Aluno  $aluno
     * @return \Illuminate\Http\Response
     */
    public function showAluno(Aluno $aluno)
    {

        return view('admin.usuarios', [
            'aluno' => $aluno,
            ]);
    }



    /**
     * Show the form for editing the specified resource.
     * @param  \App\Models\Aluno  $aluno
     * @return \Illuminate\Http\Response
     */

    public function editAluno(Aluno $aluno)
    {
        return view('admin.usuarios', [
            'aluno' => $aluno,
            ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Aluno  $aluno
     * @return \Illuminate\Http\Response
     */

    public function updateAluno(Request $request, Aluno $aluno)
    {
        $usuarioEmail = Aluno::where('alu_email', '=', $request->input('alu_email'))->first();
        $usuarioId = Aluno::where('id', '=', $request->input('id'))->first();

        if($usuarioEmail){
            if($usuarioEmail->alu_email != $usuarioId->alu_email){
                return redirect()->route('admin.usuarios')
                                    ->with('error', 'Esse email já está sendo usado!');
            } else {
                try{

                    $dados = $request->validate([
                        'id' => 'required',
                        'alu_nome' => 'required',
                        'alu_data_nascimento' => 'required|date',
                        'alu_endereco' => 'required',
                        'alu_mensalidade' => 'required',
                        'alu_celular' => 'required',
                        'alu_cpf' => 'required|cpf',
                    ]);

                    $aluno->id = $request->id;
                    $aluno->alu_nome = $request->alu_nome;
                    $aluno->alu_data_nascimento = $request->alu_data_nascimento;
                    $aluno->alu_endereco = $request->alu_endereco;
                    $aluno->alu_mensalidade = $request->alu_mensalidade;
                    $aluno->alu_celular = $request->alu_celular;
                    $aluno->alu_cpf = $request->alu_cpf;

                    $aluno->save();

                    $queryUser = User::where('alu_id', $request->id)->first();
                    if(isset($queryUser)){
                        $user = User::where('alu_id', $request->id)->first();

                        $user->alu_id = $request->id;
                        $user->name = $request->alu_nome;
                        $user->save();
                    }

                        return redirect()->route('admin.usuarios')
                                    ->with('success', 'Aluno atualizado com sucesso!');

                } catch (\Illuminate\Validation\ValidationException $e) {
                    return redirect()->route('admin.usuarios')
                ->with('error', 'O Cpf é inválido.');
                }
            }
        } else {
            try{

                $dados = $request->validate([
                    'id' => 'required',
                    'alu_nome' => 'required',
                    'alu_email' => 'required',
                    'alu_data_nascimento' => 'required|date',
                    'alu_endereco' => 'required',
                    'alu_mensalidade' => 'required',
                    'alu_celular' => 'required',
                    'alu_cpf' => 'required',
                ]);

                $aluno->update($request->all());

                $queryUser = User::where('alu_id', $request->id)->first();
                    if(isset($queryUser)){
                        $user = User::where('alu_id', $request->id)->first();

                        $user->alu_id = $request->id;
                        $user->email = $request->alu_email;
                        $user->name = $request->alu_nome;
                        $user->save();
                    }

                    return redirect()->route('admin.usuarios')
                                ->with('success', 'Aluno atualizado com sucesso!');
            } catch (\Illuminate\Validation\ValidationException $e) {
                return redirect()->route('admin.usuarios')
            ->with('error', 'O Cpf é inválido.');
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Aluno  $aluno
     * @return \Illuminate\Http\Response
     */

    public function destroyAluno(Aluno $aluno)
    {
        $usuario = User::where('email', '=', $aluno->alu_email)->first();
        $treino_geral = TreinoGeral::where('alu_id', '=', $aluno->id)->first();

        if(empty($treino_geral)){
            if(empty($usuario)){
                $aluno->delete();
            } else {
                $usuario = User::where('email', '=', $aluno->alu_email)->first();
                $usuario->delete();
                $aluno->delete();
            }
        } else {
            return redirect()->route('admin.usuarios')
                        ->with('error','Aluno possue treino e não pode ser deletado!');
        }
        return redirect()->route('admin.usuarios')
                        ->with('success','Aluno deletado com sucesso!');
    }

    public function inativarAluno(Aluno $aluno){
        $usuario = User::where('email', '=', $aluno->alu_email)->first();
        $usuario->delete();

        return redirect()->route('admin.usuarios')
                        ->with('success','Aluno inativado com sucesso!');
    }

    public function search(Request $request)
    {

        $filters = $request->except('_token');
        $alunos = Aluno::where('alu_nome', 'LIKE', "%{$request->search}%")
            ->orWhere('alu_email', 'LIKE', "%{$request->search}%")
            ->orWhere('alu_cpf', 'LIKE', "%{$request->search}%")
            ->paginate(5);

        $personals = Personal::where('per_nome', 'LIKE', "%{$request->search}%")
            ->orWhere('per_email', 'LIKE', "%{$request->search}%")
            ->orWhere('per_cpf', 'LIKE', "%{$request->search}%")
            ->paginate(5);

            return view('admin.usuarios', [
                'alunos' => $alunos,
                'personals' => $personals,
                'filters' => $filters,
                ]);
    }

    // personal

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function createPersonal()
    {
        return view('admin.usuarios');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function storePersonal(Request $request)
    {
        $usuarioEmail = Personal::where('per_email', '=', $request->input('per_email'))->first();
        $usuarioEmailAlu = Aluno::where('alu_email', '=', $request->input('per_email'))->first();

        if($usuarioEmailAlu){
            return redirect()->route('admin.usuarios')
            ->with('error','Esse email já está sendo usado!');
        }
        if($usuarioEmail){
            return redirect()->route('admin.usuarios')
            ->with('error','Esse email já está sendo usado!');
        }
        else {
            try{

                $dados = $request->validate([
                    'per_nome' => 'required',
                    'per_email' => 'required',
                    'per_data_nascimento' => 'required|date',
                    'per_endereco' => 'required',
                    'per_celular' => 'required',
                    'per_cpf' => 'required|cpf',
                ]);


                $result = Personal::create($request->all());

                $tb_user = new User;
                $tb_user->per_id = $result->id;
                $tb_user->name = $request->per_nome;
                $tb_user->email = $request->per_email;
                $tb_user->password = bcrypt('12345678');
                $tb_user->type = 2;

                $result = $tb_user->save();

                return redirect()->route('admin.usuarios')
                                ->with('success','Professor criado com sucesso!');
            } catch (\Illuminate\Validation\ValidationException $e) {
                return redirect()->route('admin.usuarios')
            ->with('error', 'O Cpf é inválido.');
            }
            }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Personal  $personal
     * @return \Illuminate\Http\Response
     */

    public function ativarPersonal(Personal $personal)
    {
        $usuario = User::where('email', '=', $personal->per_email)->first();

        if(empty($usuario)){
            $per_id = $personal->id;
            $per_email = $personal->per_email;
            $per_nome = $personal->per_nome;

            $tb_user = new User;
            $tb_user->per_id = $per_id;
            $tb_user->name = $per_nome;
            $tb_user->email = $per_email;
            $tb_user->password = bcrypt('12345678');
            $tb_user->type = 0;
            $tb_user->save();

            return redirect()->route('admin.usuarios')
                            ->with('success','Professor ativado com sucesso!');
        } else {
            return redirect()->route('admin.usuarios')
            ->with('error','Professor já está ativado!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Personal  $personal
     * @return \Illuminate\Http\Response
     */

    public function showPersonal(Personal $personal)
    {
        return view('admin.usuarios', [
            'personal' => $personal,
            ]);
    }

    /**
     * Show the form for editing the specified resource.
     * @param  \App\Models\Personal  $personal
     * @return \Illuminate\Http\Response
     */

    public function editPersonal(Personal $personal)
    {
        return view('admin.usuarios', [
            'personal' => $personal,
            ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Personal  $personal
     * @return \Illuminate\Http\Response
     */

    public function updatePersonal(Request $request, Personal $personal)
    {
        $usuarioEmail = Personal::where('per_email', '=', $request->input('per_email'))->first();
        $usuarioId = Personal::where('id', '=', $request->input('id'))->first();

        if($usuarioEmail){
            if($usuarioEmail->per_email != $usuarioId->per_email){
                return redirect()->route('admin.usuarios')
                                    ->with('error', 'Esse email já está sendo usado!');
            } else {
                try{

                    $dados =
                    $request->validate([
                        'per_nome' => 'required',
                        'per_data_nascimento' => 'required|date',
                        'per_endereco' => 'required',
                        'per_celular' => 'required',
                        'per_cpf' => 'required',
                    ]);

                    $personal->id = $request->id;
                    $personal->per_nome = $request->per_nome;
                    $personal->per_data_nascimento = $request->per_data_nascimento;
                    $personal->per_endereco = $request->per_endereco;
                    $personal->per_celular = $request->per_celular;
                    $personal->per_cpf = $request->per_cpf;

                    $personal->save();

                    $queryUser = User::where('per_id', $request->id)->first();
                    if(isset($queryUser)){
                        $user = User::where('per_id', $request->id)->first();

                        $user->per_id = $request->id;
                        $user->name = $request->alu_nome;
                        $user->save();
                    }

                        return redirect()->route('admin.usuarios')
                                    ->with('success', 'Professor atualizado com sucesso!');
                } catch (\Illuminate\Validation\ValidationException $e) {
                    return redirect()->route('admin.usuarios')
                ->with('error', 'O Cpf é inválido.');
                }
            }
        } else {
            try{

                $dados = $request->validate([
                    'per_nome' => 'required',
                    'per_email' => 'required',
                    'per_data_nascimento' => 'required|date',
                    'per_endereco' => 'required',
                    'per_celular' => 'required',
                    'per_cpf' => 'required|cpf',
                ]);

                $personal->update($request->all());

                $queryUser = User::where('per_id', $request->id)->first();
                    if(isset($queryUser)){
                        $user = User::where('per_id', $request->id)->first();

                        $user->per_id = $request->id;
                        $user->email = $request->per_email;
                        $user->name = $request->alu_nome;
                        $user->save();
                    }

                    return redirect()->route('admin.usuarios')
                                ->with('success', 'Professor atualizado com sucesso!');
            } catch (\Illuminate\Validation\ValidationException $e) {
                return redirect()->route('admin.usuarios')
            ->with('error', 'O Cpf é inválido.');
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Personal  $personal
     * @return \Illuminate\Http\Response
     */

    public function destroyPersonal(Personal $personal)
    {
        $usuario = User::where('email', '=', $personal->per_email)->first();
        $treino_geral = TreinoGeral::where('per_id', '=', $personal->id)->first();




        if(empty($treino_geral)){
            if(empty($usuario)){
                $personal->delete();
            } else {
                $usuario = User::where('email', '=', $personal->per_email)->first();
                $usuario->delete();
                $personal->delete();
            }
        } else {
            return redirect()->route('admin.usuarios')
                        ->with('error','Esse professor possue vinculo com um treino e não pode ser deletado!');
        }

        return redirect()->route('admin.usuarios')
                        ->with('success','Professor deletado com sucesso!');
    }

    public function inativarPersonal(Personal $personal)
    {
        $usuario = User::where('email', '=', $personal->per_email)->first();
        $usuario->delete();

        return redirect()->route('admin.usuarios')
                        ->with('success','Professor inativado com sucesso!');
    }


}
