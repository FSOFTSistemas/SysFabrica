<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Empresa;
use App\Models\Endereco;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Wavey\Sweetalert\Sweetalert;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $empresa = Auth::user()->empresa_id;
            $clientes = Cliente::where('empresa_id', $empresa)
                ->with('endereco')
                ->get();

            return view('clientes.index', compact('clientes'));
        } catch (Exception $e) {
            dd($e->getMessage());
            return back()->with('error', 'Erro ao carregar os clientes: ' . $e->getMessage());
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        try {
            $empresa = Auth::user()->empresa_id;
            $enderecos = Endereco::where('empresa_id', $empresa)->get();
            return view('clientes.form', compact('enderecos'));
        } catch (Exception $e) {
            return back()->with('error', 'Erro ao carregar o formulário de cadastro: ' . $e->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'razaoSocial' => 'required|string|max:255',
                'nomeFantasia' => 'nullable|string|max:255',
                'cnpj' => 'nullable|string|max:18',
                'ie' => 'nullable|string|max:20',
                'telefone' => 'required|string|max:15',
                'email' => 'required|string|max:255',
                'endereco_id' => 'nullable|exists:enderecos,id',
            ]);

            Cliente::create([
                'razaoSocial' => $request->razaoSocial,
                'empresa_id' => Auth::user()->empresa_id,
                'nomeFantasia' => $request->nomeFantasia,
                'cnpj' => $request->cnpj,
                'ie' => $request->ie,
                'telefone' => $request->telefone,
                'email' => $request->email,
                'endereco_id' => $request->endereco_id,
            ]);
            Sweetalert::success('Cliente criado com sucesso.', 'Sucesso');
            return redirect()->route('clientes.index')->with('success', 'Cliente criado com sucesso.');
        } catch (\Exception $e) {

            dd($e->getMessage());
            Sweetalert::error('Erro ao criar o cliente' . $e->getMessage(), 'Erro');
            return redirect()->back()->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Cliente $cliente)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cliente $cliente)
    {
        try {
            $empresa = Auth::user()->empresa_id;
            $enderecos = Endereco::where('empresa_id', $empresa)->get();
            $cliente = Cliente::find($cliente->id);
            return view('clientes.form', compact('enderecos', 'cliente'));
        } catch (Exception $e) {
            return back()->with('error', 'Erro ao carregar o formulário de edição: ' . $e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cliente $cliente)
    {
        try {
            $request->validate([
                'razaoSocial' => 'required|string|max:255',
                'nomeFantasia' => 'nullable|string|max:255',
                'cnpj' => 'nullable|string|max:18',
                'cpf' => 'nullable|string|max:14',
                'ie' => 'nullable|string|max:20',
                'telefone' => 'required|string|max:15',
                'endereco_id' => 'nullable|exists:enderecos,id',
            ]);

            $cliente = Cliente::findOrFail($cliente->id);
            $cliente->update([
                'razaoSocial' => $request->razaoSocial,
                'empresa_id' => Auth::user()->empresa_id,
                'nomeFantasia' => $request->nomeFantasia,
                'cnpj' => $request->cnpj,
                'cpf' => $request->cpf,
                'ie' => $request->ie,
                'telefone' => $request->telefone,
                'endereco_id' => $request->endereco_id,
            ]);
            Sweetalert::success('Cliente atualizado com sucesso', 'Sucesso');
            return redirect()->route('clientes.index')->with('success', 'Cliente atualizado com sucesso.');
        } catch (Exception $e) {
            Sweetalert::success('Erro ao atualizar o cliente '.$e->getMessage(), 'error');
            return back()->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cliente $cliente)
    {
        try {
            $cliente = Cliente::findOrFail($cliente->id);
            $cliente->delete();
            Sweetalert::success('Cliente deletado com sucesso.', 'Sucesso');
            return redirect()->route('clientes.index')->with('success', 'Cliente deletado com sucesso.');
        } catch (Exception $e) {
            Sweetalert::success('Erro ao deletar o cliente ', 'error');
            return back()->withInput();
        }
    }
}
