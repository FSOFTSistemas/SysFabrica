<?php

namespace App\Http\Controllers;

use App\Models\FormaPagamento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Wavey\Sweetalert\Sweetalert;

class FormaPagamentoController extends Controller
{

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'descricao' => 'required|string|max:255',
            ]);

            FormaPagamento::create($validated);
            Sweetalert::success('Registro criado com sucesso!', 'Sucesso');
            return redirect()->route('vendas.index')->with('success', 'Registro criado com sucesso!');
        } catch (\Exception $e) {
            Sweetalert::error('Erro ao criar!', $e->getMessage());
            return redirect()->back()->withInput();
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $validated = $request->validate([
                'descricao' => 'required|string|max:255',
            ]);

            $formaPagamento = FormaPagamento::find($id);

            $formaPagamento->update($validated);
            Sweetalert::success('Registro atualizado com sucesso!', 'Sucesso');
            return redirect()->route('vendas.index')->with('success', 'Registro atualizado com sucesso!');
        } catch (\Exception $e) {
            Sweetalert::error('Erro ao atualizar!', $e->getMessage());
            return redirect()->back()->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FormaPagamento $formaPagamento)
    {
        try {
            $formaPagamento->delete();
            Sweetalert::success('Registro excluído com sucesso!', 'Sucesso');
            return redirect()->route('vendas.index')->with('success', 'Registro excluído com sucesso!');
        } catch (\Exception $e) {
            Sweetalert::error('Erro ao excluir!', $e->getMessage());
            return redirect()->back()->withInput();
        }
    }
}
