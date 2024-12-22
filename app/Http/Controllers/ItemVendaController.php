<?php

namespace App\Http\Controllers;

use App\Models\ItemVenda;
use Illuminate\Http\Request;

class ItemVendaController extends Controller
{
   
    public function index()
    {
        $itensVenda = ItemVenda::with(['produto', 'venda'])->get();
        return view('itens_venda.index', compact('itensVenda'));
    }

    public function create()
    {
        return view('itens_venda.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'produto_id' => 'required|exists:produtos,id',
            'venda_id' => 'required|exists:vendas,id',
            'qtd' => 'required|integer',
            'unitario' => 'required|numeric',
            'desconto' => 'nullable|numeric',
            'subtotal' => 'required|numeric',
        ]);

        ItemVenda::create($data);

        return redirect()->route('itens_venda.index')->with('success', 'Item de venda criado com sucesso!');
    }

    public function show(ItemVenda $itemVenda)
    {
        return view('itens_venda.show', compact('itemVenda'));
    }

    public function edit(ItemVenda $itemVenda)
    {
        return view('itens_venda.edit', compact('itemVenda'));
    }

    public function update(Request $request, ItemVenda $itemVenda)
    {
        $data = $request->validate([
            'produto_id' => 'required|exists:produtos,id',
            'venda_id' => 'required|exists:vendas,id',
            'qtd' => 'required|integer',
            'unitario' => 'required|numeric',
            'desconto' => 'nullable|numeric',
            'subtotal' => 'required|numeric',
        ]);

        $itemVenda->update($data);

        return redirect()->route('itens_venda.index')->with('success', 'Item de venda atualizado com sucesso!');
    }

    public function destroy(ItemVenda $itemVenda)
    {
        $itemVenda->delete();

        return redirect()->route('itens_venda.index')->with('success', 'Item de venda excluído com sucesso!');
    }
}
