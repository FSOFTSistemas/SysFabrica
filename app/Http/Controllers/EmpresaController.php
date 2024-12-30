<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use App\Models\Endereco;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EmpresaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $empresas = Empresa::with('endereco')->get();
        return view('empresas.index', compact('empresas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $enderecos = Endereco::all();
        return view('empresas.form', compact('enderecos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'razao_social' => 'required|string|max:255',
            'nome_fantasia' => 'required|string|max:255',
            'endereco_id' => 'nullable|exists:enderecos,id',
        ]);

        if ($validator->fails()) {
            return redirect()->route('empresas.create')
                        ->withErrors($validator)
                        ->withInput();
        }

        Empresa::create([
            'razao_social' => $request->razao_social,
            'nome_fantasia' => $request->nome_fantasia,
            'endereco_id' => $request->endereco_id,
        ]);

        return redirect()->route('empresas.index')->with('success', 'Empresa criada com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Empresa $empresa)
    {
        return view('empresas.show', compact('empresa'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Empresa $empresa)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Empresa $empresa)
    {
        $validator = Validator::make($request->all(), [
            'razao_social' => 'required|string|max:255',
            'nome_fantasia' => 'required|string|max:255',
            'endereco_id' => 'nullable|exists:enderecos,id',
        ]);

        if ($validator->fails()) {
            return redirect()->route('empresas.edit', $empresa)
                        ->withErrors($validator)
                        ->withInput();
        }

        $empresa->update([
            'razao_social' => $request->razao_social,
            'nome_fantasia' => $request->nome_fantasia,
            'endereco_id' => $request->endereco_id,
        ]);

        return redirect()->route('empresas.index')->with('success', 'Empresa atualizada com sucesso!');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Empresa $empresa)
    {
        $empresa->delete();

        return redirect()->route('empresas.index')->with('success', 'Empresa deletada com sucesso!');
    }
}
