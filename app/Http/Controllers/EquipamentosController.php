<?php

namespace App\Http\Controllers;

use App\Models\Equipamento;
use Illuminate\Http\Request;

class EquipamentosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $equipamentos = Equipamento::latest()->paginate(5);
        return view('admin.viewsTreino.equipamentos', [
            'equipamentos' => $equipamentos,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.viewsTreino.equipamentos');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $equipamentoNome = Equipamento::where('eq_nome', '=', $request->input('eq_nome'))->first();

        if($equipamentoNome){
            return redirect()->route('equipamentos.index')
            ->with('error','Esse equipamento já está cadastrado!');
        } else {
        $request->validate([
            'eq_nome' => 'required',
        ]);

        Equipamento::create($request->all());

        return redirect()->route('equipamentos.index')
                        ->with('success','Equipamento criado com sucesso!');
            }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Equipamento  $equipamento
     * @return \Illuminate\Http\Response
     */
    public function show(Equipamento $equipamento)
    {
        return view('admin.viewsTreino.equipamentos', [
            'equipamento' => $equipamento,
            ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Equipamento  $equipamento
     * @return \Illuminate\Http\Response
     */
    public function edit(Equipamento $equipamento)
    {
        return view('admin.viewsTreino.equipamentos', [
            'equipamento' => $equipamento,
            ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Equipamento  $equipamento
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Equipamento $equipamento)
    {
        $nomeEq = Equipamento::where('eq_nome', '=', $request->input('eq_nome'))->first();
        $eqId = Equipamento::where('id', '=', $request->input('id'))->first();

        if($nomeEq){
            if($nomeEq->eq_nome != $eqId->eq_nome){
                return redirect()->route('equipamentos.index')
                                    ->with('error', 'Esse equipamento já está cadastrado!');
            } else {
                $request->validate([
                    'eq_nome' => 'required',
                ]);

                $equipamento->id = $request->id;
                $equipamento->exe_nome = $request->exe_nome;

                $equipamento->save();

                    return redirect()->route('equipamentos.index')
                                ->with('success', 'Equipamento atualizado!');
            }
        } else {
            $request->validate([
                'eq_nome' => 'required',
            ]);

            $equipamento->update($request->all());

                return redirect()->route('equipamentos.index')
                            ->with('success', 'Equipamento atualizado!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Equipamento  $equipamento
     * @return \Illuminate\Http\Response
     */
    public function destroy(Equipamento $equipamento)
    {
        $equipamento->delete();

        return redirect()->route('equipamentos.index')
                        ->with('success','Equipamento excluido com sucesso!');
    }

    public function search(Request $request)
    {

        $filters = $request->except('_token');
        $equipamentos = Equipamento::where('eq_nome', 'LIKE', "%{$request->search}%")
            ->paginate(5);

            return view('admin.viewsTreino.equipamentos', [
                'equipamentos' => $equipamentos,
                ]);
    }
}
