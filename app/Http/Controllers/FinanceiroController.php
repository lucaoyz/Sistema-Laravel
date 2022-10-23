<?php

namespace App\Http\Controllers;

use App\Models\TipoPagto;
use Illuminate\Http\Request;

class FinanceiroController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tipoPagtos = TipoPagto::latest()->paginate(5);

        return view('admin.financeiro', [
            'tipoPagtos' => $tipoPagtos,
        ]);
    }

    public function tipoPagtoIndex()
    {
        $tipoPagtos = TipoPagto::latest()->paginate(5);

        return view('admin.tipopagto', [
            'tipoPagtos' => $tipoPagtos,
        ]);
    }

    public function tipopagtoSearch(Request $request)
    {

        $filters = $request->except('_token');
        $tipoPagtos = TipoPagto::where('tpg_descricao', 'LIKE', "%{$request->search}%")
            ->paginate(5);

            return view('admin.tipopagto', [
                'tipoPagtos' => $tipoPagtos,
                'filters' => $filters,
                ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function tipopagtoStore(Request $request)
    {
        $tipoPagto = TipoPagto::where('tpg_descricao', '=', $request->input('tpg_descricao'))->first();

        if($tipoPagto){
            return redirect()->route('admin.financeiro.tipopagto.index')
            ->with('error','Esse tipo de pagamento já está cadastrado!');
        } else {
        $request->validate([
            'tpg_descricao' => 'required',
        ]);

        TipoPagto::create($request->all());

        return redirect()->route('admin.financeiro.tipopagto.index')
                        ->with('success','Tipo de pagamento cadastrado com sucesso!');
            }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TipoPagto  $TipoPagto
     * @return \Illuminate\Http\Response
     */
    public function tipopagtoUpdate(Request $request, TipoPagto $tipoPagto)
    {
        $tpg_descricao = TipoPagto::where('tpg_descricao', '=', $request->input('tpg_descricao'))->first();
        $tpg_id = TipoPagto::where('id', '=', $request->input('id'))->first();

        if($tpg_descricao){
            if($tpg_descricao->tpg_descricao != $tpg_id->tpg_descricao){
                return redirect()->route('admin.financeiro.tipopagto.index')
                                    ->with('error', 'Esse tipo de pagamento já está cadastrado!');
            } else {
                $request->validate([
                    'tpg_descricao' => 'required',
                ]);

                $tipoPagto->id = $request->id;
                $tipoPagto->tpg_descricao = $request->tpg_descricao;

                $tipoPagto->save();

                    return redirect()->route('admin.financeiro.tipopagto.index')
                                ->with('success', 'Tipo de pagamento atualizado com sucesso!');
            }
        } else {
            $request->validate([
                'tpg_descricao' => 'required',
            ]);

            $tipoPagto->update($request->all());
            //dd($tipoPagto);
                    return redirect()->route('admin.financeiro.tipopagto.index')
                        ->with('success', 'Tipo de pagamento atualizado com sucesso!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TipoPagto  $tipoPagto
     * @return \Illuminate\Http\Response
     */
    public function tipopagtoDelete(TipoPagto $tipoPagto)
    {
        $tipoPagto->delete();

        return redirect()->route('admin.financeiro.tipopagto.index')
                    ->with('success', 'Tipo de pagamento excluído com sucesso!');
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
