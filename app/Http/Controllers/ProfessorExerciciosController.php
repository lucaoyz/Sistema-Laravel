<?php

namespace App\Http\Controllers;

use App\Models\Exercicio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfessorExerciciosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $exercicios = Exercicio::latest()->paginate(5);

        return view('professor.viewsTreino.exercicios', [
            'exercicios' => $exercicios,
            ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('professor.viewsTreino.exercicios');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $exercicioNome = Exercicio::where('exe_nome', '=', $request->input('exe_nome'))->first();

        if($exercicioNome){
            return redirect()->route('exercicios.index')
            ->with('error','Esse exercício já está cadastrado!');
        } else {
        $request->validate([
            'exe_nome' => 'required',
            'exe_membro' => 'required',
            'exe_descricao' => 'nullable',
            'exe_foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg'
        ]);

        $input = $request->all();
        // Upload de imagem
        if ($image = $request->file('exe_foto')) {
            $destinationPath = public_path('img/exercicios');
            $exercicioFotoNome = date('dmY') . "-" . $image->getClientOriginalName();
            $image->move($destinationPath, $exercicioFotoNome);
            $input['exe_foto'] = "$exercicioFotoNome";
        }

        Exercicio::create($input);

        return redirect()->route('professor.exercicios.index')
                        ->with('success','Exercício criado com sucesso!');
            }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Exercicio  $exercicio
     * @return \Illuminate\Http\Response
     */
    public function show(Exercicio $exercicio)
    {
        return view('professor.viewsTreino.exercicios', [
            'exercicio' => $exercicio,
            ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Exercicio  $exercicio
     * @return \Illuminate\Http\Response
     */
    public function edit(Exercicio $exercicio)
    {
        return view('professor.viewsTreino.exercicios', [
            'exercicio' => $exercicio,
            ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Exercicio  $exercicio
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Exercicio $exercicio)
    {
        $nomeExe = Exercicio::where('exe_nome', '=', $request->input('exe_nome'))->first();
        $exeId = Exercicio::where('id', '=', $request->input('id'))->first();

        if($nomeExe){
            if($nomeExe->exe_nome != $exeId->exe_nome){
                return redirect()->route('exercicios.index')
                                    ->with('error', 'Esse exercício já está cadastrado!');
            } else {
                $request->validate([
                    'exe_nome' => 'required',
                    'exe_membro' => 'required',
                    'exe_descricao' => 'nullable',
                    'exe_foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg'
                ]);

                // Atualização de imagem
                $imageName = '';
                if($request->hasFile('exe_foto')){
                    $imageName = date('dmY') . "-" . $request->exe_foto->getClientOriginalName();
                    $destinationPath = public_path('img/exercicios');
                    $request->exe_foto->move($destinationPath, $imageName);
                    if($exercicio->exe_foto){
                        Storage::delete('public/images/exercicios/' . $exercicio->exe_foto);
                    }
                } else {
                    $imageName = $exercicio->exe_foto;
                }

                $exercicio->id = $request->id;
                $exercicio->exe_nome = $request->exe_nome;
                $exercicio->exe_membro = $request->exe_membro;
                $exercicio->exe_descricao = $request->exe_descricao;
                $exercicio->exe_foto = $imageName;
                $exercicio->update();

                    return redirect()->route('professor.exercicios.index')
                                ->with('success', 'Exercício atualizado!');
            }
        } else {
            $request->validate([
                'exe_nome' => 'required',
                'exe_membro' => 'required',
                'exe_descricao' => 'nullable',
            ]);

            $exercicio->update($request->all());

                return redirect()->route('professor.exercicios.index')
                            ->with('success', 'Exercício atualizado!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Exercicio  $exercicio
     * @return \Illuminate\Http\Response
     */
    public function destroy(Exercicio $exercicio)
    {
        Storage::delete('public/img/exercicios/' . $exercicio->exe_foto);
        $exercicio->delete();

        return redirect()->route('professor.exercicios.index')
                        ->with('success','Exercício excluido com sucesso!');
    }

    public function search(Request $request)
    {

        $filters = $request->except('_token');
        $exercicios = Exercicio::where('exe_nome', 'LIKE', "%{$request->search}%")
            ->orWhere('exe_membro', 'LIKE', "%{$request->search}%")
            ->paginate(5);

            return view('professor.viewsTreino.exercicios', [
                'exercicios' => $exercicios,
                ]);
    }
}
