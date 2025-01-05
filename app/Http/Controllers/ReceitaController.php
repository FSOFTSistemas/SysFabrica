<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use App\Models\Receita;
use Illuminate\Http\Request;
use Wavey\Sweetalert\Sweetalert;

class ReceitaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($produto_id)
    {
        $produto = Produto::find($produto_id); 
        $receitas = Receita::where('produto_id', $produto_id)->get(); 

        return view('receitas.index', compact('produto', 'receitas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'descricao' => 'required|string|max:255',
                'qtd' => 'required|numeric',
                'produto_id' => 'required|exists:produtos,id',
            ]);

            $receita = Receita::create($request->all());

            Sweetalert::success('Sucesso', 'Ingrediente cadastrado com sucesso!');
            return redirect()->route('receitas.index',['produto_id' => $request['produto_id']]);
        } catch (\Exception $e) {
            dd($e->getMessage());
            SweetAlert::error('Erro', 'Falha ao cadastrar ingrediente: ' . $e->getMessage());
            return back();
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Receita $receita)
    {
        try {
            $request->validate([
                'descricao' => 'required|string|max:255',
                'qtd' => 'required|numeric',
                'produto_id' => 'required|exists:produtos,id',
            ]);

            $receita->update($request->all());

            SweetAlert::success('Sucesso', 'Ingrediente atualizado com sucesso!');
            return redirect()->route('receitas.index',['produto_id' => $request['produto_id']]);
        } catch (\Exception $e) {
            dd($e->getMessage());
            SweetAlert::error('Erro', 'Falha ao atualizar ingrediente: ' . $e->getMessage());
            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Receita $receita)
    {
        try {
            $receita->delete();

            SweetAlert::success('Sucesso', 'Ingrediente excluído com sucesso!');
            return redirect()->route('receitas.index',['produto_id' => $receita['produto_id']]);
        } catch (\Exception $e) {
            dd($e->getMessage());
            SweetAlert::error('Erro', 'Falha ao excluir ingrediente: ' . $e->getMessage());
            return back();
        }
    }
}
