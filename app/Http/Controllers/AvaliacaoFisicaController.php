<?php

namespace App\Http\Controllers;

use App\Models\Personal;
use App\Models\Aluno;
use App\Models\AvaliacaoFisica;
use App\Models\TreinoGeral;
use App\Models\User;
use App\Models\Plano;

use Illuminate\Http\Request;

class AvaliacaoFisicaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Aluno $aluno)
    {

        $avaliacaoFisicas = AvaliacaoFisica::where('alu_id', '=', $aluno->id)
        ->orderBy('created_at', 'desc')
        ->paginate(5);

        return view('admin.avaliacaoFisica', [
            'aluno' => $aluno,
            'avaliacaoFisicas' => $avaliacaoFisicas,
            ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.avaliacaoFisica', [
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Aluno $aluno)
    {
        $request->validate([
            'alu_id' => 'nullable',
            'af_kg' => 'nullable',
            'af_altura' => 'nullable',
            'af_massa_gorda' => 'nullable',
            'af_massa_magra' => 'nullable',
            'af_imc' => 'nullable',
            'af_cm_bracoE' => 'nullable',
            'af_cm_bracoD' => 'nullable',
            'af_cm_antebracoE' => 'nullable',
            'af_cm_antebracoD' => 'nullable',
            'af_cm_coxaE' => 'nullable',
            'af_cm_coxaD' => 'nullable',
            'af_cm_panturrilhaE' => 'nullable',
            'af_cm_panturrilhaD' => 'nullable',
            'af_cm_torax' => 'nullable',
            'af_cm_cintura' => 'nullable',
            'af_cm_abdomen' => 'nullable',
            'af_cm_quadril' => 'nullable',
            'af_cm_pescoco' => 'nullable',
            'af_cm_ombro' => 'nullable',
            'af_dc_subescapular' => 'nullable',
            'af_dc_triceps' => 'nullable',
            'af_dc_biceps' => 'nullable',
            'af_dc_torax' => 'nullable',
            'af_dc_axilarMedia' => 'nullable',
            'af_dc_suprailiaca' => 'nullable',
            'af_dc_abdominal' => 'nullable',
            'af_dc_coxaMedial' => 'nullable',
            'af_dc_panturrilhaMedial' => 'nullable',
            'af_objetivo' => 'nullable',
        ]);

        $input = $request->all();
        $kg = $request->af_kg;
        $altura = $request->af_altura;
        $alturaIMC = $altura * $altura;
        $imc = $kg / $alturaIMC;

        $input['af_imc'] = round($imc, 2);
        AvaliacaoFisica::create($input);

        return redirect()->route('alunos.avaliacaoFisica', $aluno->id)
                        ->with('success','Avaliação Física cadastrada com sucesso!');

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
    public function update(Request $request, Aluno $aluno, AvaliacaoFisica $avaliacaoFisica)
    {
        $avaliacaoFisica = AvaliacaoFisica::where('id', '=', $request->input('id'))->first();
        $request->validate([
            'alu_id' => 'nullable',
            'af_kg' => 'nullable',
            'af_altura' => 'nullable',
            'af_massa_gorda' => 'nullable',
            'af_massa_magra' => 'nullable',
            'af_imc' => 'nullable',
            'af_cm_bracoE' => 'nullable',
            'af_cm_bracoD' => 'nullable',
            'af_cm_antebracoE' => 'nullable',
            'af_cm_antebracoD' => 'nullable',
            'af_cm_coxaE' => 'nullable',
            'af_cm_coxaD' => 'nullable',
            'af_cm_panturrilhaE' => 'nullable',
            'af_cm_panturrilhaD' => 'nullable',
            'af_cm_torax' => 'nullable',
            'af_cm_cintura' => 'nullable',
            'af_cm_abdomen' => 'nullable',
            'af_cm_quadril' => 'nullable',
            'af_cm_pescoco' => 'nullable',
            'af_cm_ombro' => 'nullable',
            'af_dc_subescapular' => 'nullable',
            'af_dc_triceps' => 'nullable',
            'af_dc_biceps' => 'nullable',
            'af_dc_torax' => 'nullable',
            'af_dc_axilarMedia' => 'nullable',
            'af_dc_suprailiaca' => 'nullable',
            'af_dc_abdominal' => 'nullable',
            'af_dc_coxaMedial' => 'nullable',
            'af_dc_panturrilhaMedial' => 'nullable',
            'af_objetivo' => 'nullable',
        ]);

        $input = $request->all();
        $kg = $request->af_kg;
        $altura = $request->af_altura;
        $alturaIMC = $altura * $altura;
        $imc = $kg / $alturaIMC;
        $input['af_imc'] = round($imc, 2);

        $avaliacaoFisica->update($input);
        //dd($avaliacaoFisica);
        return redirect()->route('alunos.avaliacaoFisica', $aluno->id)
                        ->with('success','Avaliação Física atualizada com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Aluno $aluno, AvaliacaoFisica $avaliacaoFisica)
    {
        $avaliacaoFisica->delete();

        return redirect()->route('alunos.avaliacaoFisica', $aluno->id)
        ->with('success','Avaliação Física excluída com sucesso!');

    }
}
