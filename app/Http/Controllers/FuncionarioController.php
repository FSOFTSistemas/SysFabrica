<?php

namespace App\Http\Controllers;

use App\Models\Funcionario;
use Illuminate\Http\Request;

class FuncionarioController extends Controller
{
    public function index()
    {
        $funcionarios = Funcionario::with(['empresa', 'endereco'])->get();
        return view('funcionarios.index', compact('funcionarios'));
    }

    public function create()
    {
        return view('funcionarios.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nome' => 'required|string|max:255',
            'empresa_id' => 'required|exists:empresas,id',
            'endereco_id' => 'required|exists:enderecos,id',
            'telefone' => 'required|string|max:20',
            'comissao' => 'nullable|numeric',
            'admissao' => 'required|date',
            'situacao' => 'required|integer',
        ]);

        Funcionario::create($data);

        return redirect()->route('funcionarios.index')->with('success', 'Funcionário criado com sucesso!');
    }

    public function show(Funcionario $funcionario)
    {
        return view('funcionarios.show', compact('funcionario'));
    }

    public function edit(Funcionario $funcionario)
    {
        return view('funcionarios.edit', compact('funcionario'));
    }

    public function update(Request $request, Funcionario $funcionario)
    {
        $data = $request->validate([
            'nome' => 'required|string|max:255',
            'empresa_id' => 'required|exists:empresas,id',
            'endereco_id' => 'required|exists:enderecos,id',
            'telefone' => 'required|string|max:20',
            'comissao' => 'nullable|numeric',
            'admissao' => 'required|date',
            'situacao' => 'required|integer',
        ]);

        $funcionario->update($data);

        return redirect()->route('funcionarios.index')->with('success', 'Funcionário atualizado com sucesso!');
    }

    public function destroy(Funcionario $funcionario)
    {
        $funcionario->delete();

        return redirect()->route('funcionarios.index')->with('success', 'Funcionário excluído com sucesso!');
    }
}
