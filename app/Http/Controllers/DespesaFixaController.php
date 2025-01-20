<?php

namespace App\Http\Controllers;

use App\Models\DespesaFixa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Wavey\Sweetalert\Sweetalert;

class DespesaFixaController extends Controller
{
    public function index()
    {
        $despesasFixas = DespesaFixa::where('empresa_id', Auth::user()->empresa_id)->get();
        return view('despesas.index', compact('despesasFixas'));
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'descricao' => 'required|string|max:255',
                'valor' => 'required|numeric|min:0',
            ]);

            $validated['empresa_id'] = Auth::user()->empresa_id;
            $despesaFixa = DespesaFixa::create($validated);

            Sweetalert::success('Despesa cadastrada com sucesso!', 'Sucesso');
            return redirect()->route('despesas.index')->with('success', 'Despesa criada com sucesso !');
        } catch (\Exception $e) {
            Sweetalert::error('Erro ao criar despesa!', 'Erro');
            return redirect()->back()->withInput()->withErrors('error', $e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $despesaFixa = DespesaFixa::findOrFail($id);

            $validated = $request->validate([
                'descricao' => 'sometimes|required|string|max:255',
                'valor' => 'sometimes|required|numeric|min:0',
            ]);

            $validated['empresa_id'] = Auth::user()->empresa_id;
            $despesaFixa->update($validated);

            Sweetalert::success('Despesa atualizada com sucesso!', 'Sucesso');
            return redirect()->route('despesas.index')->with('success', 'Despesa atualizada com sucesso !');
        } catch (\Exception $e) {
            Sweetalert::error('Erro ao atualziar despesa!', 'Erro');
            return redirect()->back()->withInput()->withErrors('error', $e->getMessage());
        }
    }

    public function destroy($id)
    {

        try {
            $despesaFixa = DespesaFixa::findOrFail($id);
            $despesaFixa->delete();

            Sweetalert::success('Despesa deletada com sucesso!', 'Sucesso');
            return redirect()->route('despesas.index')->with('success', 'Despesa atualizada com sucesso !');

        } catch (\Exception $e) {
            Sweetalert::error('Erro ao deletar despesa!', 'Erro');
            return redirect()->back()->withInput()->withErrors('error', $e->getMessage());
        }
    }
}
