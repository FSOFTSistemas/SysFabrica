<?php

namespace App\Http\Controllers;

use App\Models\Estoque;
use App\Models\Produto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Wavey\Sweetalert\Sweetalert;

class EstoqueController extends Controller
{

    public function index()
    {
        try {
            $estoques = Estoque::where('empresa_id', Auth::user()->empresa_id)->get();
            $produtos = Produto::where('empresa_id', Auth::user()->empresa_id)->get();
            return view('estoques.index', compact('estoques', 'produtos'));
        } catch (\Exception $e) {
            dd($e->getMessage());
            Sweetalert::error('Erro!', 'Erro ao carregar os estoques: ' . $e->getMessage());
            return redirect()->back();
        }
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
            $request->validate([
                'estoque_atual' => 'required|numeric|min:0',
                'entradas' => 'nullable|numeric|min:0',
                'saidas' => 'nullable|numeric|min:0',
                'produto_id' => 'required|exists:produtos,id',
            ]);

            $request['empresa_id'] = Auth::user()->empresa_id;
            Estoque::create($request->all());
            Sweetalert::success('Estoque criado com sucesso!', 'Sucesso');
            return redirect()->route('estoques.index');
        } catch (\Exception $e) {
            Sweetalert::error('Erro ao criar estoque!', $e->getMessage());
            return redirect()->back()->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Estoque $estoque)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Estoque $estoque)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Estoque $estoque)
    {
        try {
            $request->validate([
                'estoque_atual' => 'required|numeric|min:0',
                'entradas' => 'nullable|numeric|min:0',
                'saidas' => 'nullable|numeric|min:0',
            ]);

            $estoque->update($request->all());
            Sweetalert::success('Estoque atualizado com sucesso!', 'Sucesso');
            return redirect()->route('estoques.index');
        } catch (\Exception $e) {
            Sweetalert::error('Erro ao atualizar estoque!', $e->getMessage());
            return redirect()->back()->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Estoque $estoque)
    {
        try {
            $estoque->delete();
            Sweetalert::success('Estoque removido com sucesso!', 'Sucesso');
            return redirect()->route('estoques.index');
        } catch (\Exception $e) {
            Sweetalert::error('Erro ao excluir estoque!', $e->getMessage());
            return redirect()->back();
        }
    }
}
