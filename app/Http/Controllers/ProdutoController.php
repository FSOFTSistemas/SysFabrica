<?php

namespace App\Http\Controllers;

use App\Models\Estoque;
use App\Models\Produto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Wavey\Sweetalert\Sweetalert;

class ProdutoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $produtos = Produto::where('empresa_id', Auth::user()->empresa_id)->get();
        return view('produtos.index', compact('produtos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $validated = $request->validate([
                'descricao' => 'required|string|max:255',
                'status' => 'required|in:ativo,inativo',
                'insumo' => 'required|in:sim,nao',
                'comissao' => 'nullable|numeric|min:0',
                'precocusto' => 'required|numeric|min:0',
                'precoVenda' => 'required|numeric|min:0',
            ]);
            $validated['empresa_id'] = Auth::user()->empresa_id;
            $produto = Produto::create($validated);
            $id = $produto->id; 
            $this->inserirEstoque($id);
            DB::commit();

            Sweetalert::success('Produto criado com sucesso!', 'Sucesso');
            return redirect()->route('produtos.index');
        } catch (\Exception $e) {
            dd($e->getMessage());
            DB::rollBack();
            Sweetalert::error('Falha ao criado produto!' . $e->getMessage(), 'Error');
            return redirect()->back()->withInput()->withErrors($e->getMessage());
        }
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Produto $produto)
    {
        try {

            $validated = $request->validate([
                'descricao' => 'required|string|max:255',
                'status' => 'required|in:ativo,inativo',
                'insumo' => 'required|in:sim,nao',
                'comissao' => 'nullable|numeric|min:0',
                'precocusto' => 'required|numeric|min:0',
                'precoVenda' => 'required|numeric|min:0',
            ]);

            $produto->update($validated);
            Sweetalert::success('Produto atualizado com sucesso!', 'Sucesso');
            return redirect()->route('produtos.index');
        } catch (\Exception $e) {

            Sweetalert::error('Falha ao atualizar produto!' . $e->getMessage(), 'Error');
            return redirect()->back()->withInput()->withErrors($e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Produto $produto)
    {
        try {

            $produto->delete();
            Sweetalert::success('Produto deletado com sucesso!', 'Sucesso');
            return redirect()->route('produtos.index');
        } catch (\Exception $e) {
            Sweetalert::error('Falha ao deletar produto!' . $e->getMessage(), 'Error');
            return redirect()->back()->withInput()->withErrors($e->getMessage());
        }
    }

    public function inserirEstoque($idProduto) {
        try {
            Estoque::create([
                'produto_id' => $idProduto,
                'estoque_atual' => 1,
                'entradas' => 1,
                'saidas' => 0,
                'empresa_id' => Auth::user()->empresa_id
            ]);
        } catch (\Exception $e) {
            Sweetalert::error('Erro ao criar o estoque: ' . $e->getMessage(), 'Erro');
            return back();
        }
    }
}
