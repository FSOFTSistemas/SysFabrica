<?php

namespace App\Http\Controllers;

use App\Models\Estoque;
use App\Models\Funcionario;
use App\Models\OrdemProducao;
use App\Models\Produto;
use App\Models\Receita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrdemProducaoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $funcionarios = Funcionario::daEmpresa(Auth::user()->empresa_id)->get();
        $produtos = Produto::where('insumo', Produto::INSUMO_NAO)->daEmpresa(Auth::user()->empresa_id)->get();
        $ordens = OrdemProducao::with('funcionario', 'produto', 'empresa')->daEmpresa(Auth::user()->empresa_id)->get();
        return view('producao.index', compact('ordens', 'funcionarios', 'produtos'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'funcionario_id' => 'required|exists:funcionarios,id',
                'produto_id' => 'required|exists:produtos,id',
                'producao_estimada' => 'required|integer|min:1',
                'producao_real' => 'required',
                'status' => 'required|string',
            ]);

            $validated['empresa_id'] = Auth::user()->empresa_id;
            $ordem = OrdemProducao::create($validated);

            // Realiza baixa no estoque dos insumos
            $this->baixarEstoqueDeInsumos($ordem->produto_id, $ordem->producao_real);

            return redirect()->route('producao.index')->with('success', 'Ordem de produção criada com sucesso!');
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }

    private function baixarEstoqueDeInsumos($produtoId, $quantidadeProduzida)
    {

        try {

            // Busca a receita do produto produzido
            $receitas = Receita::where('produto_id', $produtoId)->get();

            foreach ($receitas as $receita) {
                $insumo = Produto::find($receita->ingrediente_id);

                // Verifica se o produto é um insumo
                if ($insumo->insumo === 'Sim') {
                    $estoque = Estoque::where('produto_id', $receita->produto_id)->first();
                    if ($estoque) {
                        // Calcula a quantidade a ser descontada com base na quantidade produzida
                        $quantidadeBaixa = $receita->qtd * $quantidadeProduzida;

                        // if ($estoque->estoque_atual < $quantidadeBaixa) {
                        //     throw new \Exception("Estoque insuficiente para o insumo {$insumo->descricao}");
                        // }

                        // Atualiza o estoque
                        $estoque->estoque_atual -= $quantidadeBaixa;
                        $estoque->saidas += $quantidadeBaixa;
                        $estoque->save();
                    } else {
                        throw new \Exception("Estoque do insumo {$insumo->descricao} não encontrado");
                    }
                }
            }
        } catch (\Exception $e) {
            throw $e;
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(OrdemProducao $ordemProducao)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(OrdemProducao $ordemProducao)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $ordem = OrdemProducao::findOrFail($id);

            $validated = $request->validate([
                'producao_estimada' => 'required|integer|min:1',
                'producao_real' => 'required|integer|min:1',
                'status' => 'required|string',
            ]);

            $ordem->update($validated);

            return redirect()->route('producao.index')->with('success', 'Ordem de produção atualizada com sucesso!');
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(OrdemProducao $ordemProducao)
    {
        try {
            // $ordem = OrdemProducao::findOrFail($id);
            $ordemProducao->delete();

            return redirect()->route('producao.index')->with('success', 'Ordem de produção excluída com sucesso!');
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}
