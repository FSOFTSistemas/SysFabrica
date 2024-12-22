<?php

namespace App\Http\Controllers;

use App\Models\Venda;
use Illuminate\Http\Request;

class VendaController extends Controller
{
    public function index()
    {
        $vendas = Venda::with(['cliente', 'empresa', 'usuario', 'formaPagamento'])->get();
        return view('vendas.index', compact('vendas'));
    }

    public function create()
    {
        return view('vendas.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'cliente_id' => 'required|exists:clientes,id',
            'data' => 'required|date',
            'empresa_id' => 'required|exists:empresas,id',
            'total' => 'required|numeric',
            'desconto' => 'nullable|numeric',
            'acrescimo' => 'nullable|numeric',
            'forma_pagamento_id' => 'required|exists:forma_pagamentos,id',
            'status' => 'required|string',
            'obs' => 'nullable|string',
            'usuario_id' => 'required|exists:users,id',
        ]);

        Venda::create($data);

        return redirect()->route('vendas.index')->with('success', 'Venda criada com sucesso!');
    }

    public function show(Venda $venda)
    {
        return view('vendas.show', compact('venda'));
    }

    public function edit(Venda $venda)
    {
        return view('vendas.edit', compact('venda'));
    }

    public function update(Request $request, Venda $venda)
    {
        $data = $request->validate([
            'cliente_id' => 'required|exists:clientes,id',
            'data' => 'required|date',
            'empresa_id' => 'required|exists:empresas,id',
            'total' => 'required|numeric',
            'desconto' => 'nullable|numeric',
            'acrescimo' => 'nullable|numeric',
            'forma_pagamento_id' => 'required|exists:forma_pagamentos,id',
            'status' => 'required|string',
            'obs' => 'nullable|string',
            'usuario_id' => 'required|exists:users,id',
        ]);

        $venda->update($data);

        return redirect()->route('vendas.index')->with('success', 'Venda atualizada com sucesso!');
    }

    public function destroy(Venda $venda)
    {
        $venda->delete();

        return redirect()->route('vendas.index')->with('success', 'Venda excluída com sucesso!');
    }
}
