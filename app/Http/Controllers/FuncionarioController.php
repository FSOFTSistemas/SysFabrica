<?php

namespace App\Http\Controllers;

use App\Models\Endereco;
use App\Models\Funcionario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Wavey\Sweetalert\Sweetalert;

class FuncionarioController extends Controller
{
    public function index()
    {
        $funcionarios = Funcionario::where('empresa_id', Auth::user()->empresa_id)->get();
        $enderecos = Endereco::where('empresa_id', Auth::user()->empresa_id)->get();
        return view('funcionarios.index', compact('funcionarios', 'enderecos'));
    }

    public function create()
    {
        $enderecos = Endereco::where('empresa_id', Auth::user()->empresa_id)->get();
        return view('funcionarios.modals.create', compact('enderecos'));   
    }

    public function store(Request $request)
    {
        try {
            $data = $request->validate([
                'nome' => 'required|string|max:255',
                'telefone' => 'required|string|max:20',
                'comissao' => 'nullable|numeric',
                'admissao' => 'required|date',
                'situacao' => 'required|integer',
                'endereco_id' => 'required|exists:enderecos,id',
            ]);
    
            $data['empresa_id'] = Auth::user()->empresa_id;
            Funcionario::create($data);
            Sweetalert::success('Funcionário criado com sucesso!', 'Sucesso');
            return redirect()->route('funcionarios.index');
    
        } catch (\Exception $e) {
            Sweetalert::error('Erro ao criar funcionario. '.$e->getMessage(), 'Erro!');
            return redirect()->back()->withInput();
        }
    }

    public function show(Funcionario $funcionario)
    {
        //
    }

    public function edit(Funcionario $funcionario)
    {
        //
    }

    public function update(Request $request, Funcionario $funcionario)
    {

        try {
            $data = $request->validate([
                'nome' => 'required|string|max:255',
                'endereco_id' => 'required|exists:enderecos,id',
                'telefone' => 'required|string|max:20',
                'comissao' => 'nullable|numeric',
                'admissao' => 'required|date',
                'situacao' => 'required|integer',
            ]);
            
            $data['empresa_id'] = Auth::user()->empresa_id;
            $funcionario->update($data);
            Sweetalert::success('Funcionário atualizado com sucesso!', 'Sucesso');
            return redirect()->route('funcionarios.index')->with('success', 'Funcionário atualizado com sucesso!');
        } catch (\Exception $e) {
            Sweetalert::error('Erro ao atualizar funcionario. '.$e->getMessage(), 'Erro!');
            return redirect()->back()->withInput();
        }

    }

    public function destroy(Funcionario $funcionario)
    {
        try {
            $funcionario->delete();
            Sweetalert::success('Funcionário excluído com sucesso!', 'Sucesso');
            return redirect()->route('funcionarios.index')->with('success', 'Funcionário excluído com sucesso!');
        } catch (\Exception $e) {
            Sweetalert::error('Erro ao deletar funcionario. '.$e->getMessage(), 'Erro!');
            return redirect()->back()->withInput();
        }
    }
}
