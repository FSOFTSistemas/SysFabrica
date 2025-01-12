<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use App\Models\Endereco;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Wavey\Sweetalert\Sweetalert;

class EmpresaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $empresas = Empresa::all();
        return view('config.index', compact('empresas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('config.form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {

            
            $validatedData = $request->validate([
                'cnpj' => 'required|unique:empresas',
                'ie' => 'nullable|string|max:20',
                'razao_social' => 'required|string|max:255',
                'nome_fantasia' => 'nullable|string|max:255',
                'status' => 'required|in:ativo,inativo',
                'data_vencimento' => 'nullable|date',
                'cliente_desde' => 'required|date',
                'path_logo' => 'nullable|string|max:255',
                'logradouro' => 'nullable|string|max:255',
                'numero' => 'required|string|max:20',
                'bairro' => 'required|string|max:100',
                'cidade' => 'required|string|max:100',
                'estado' => 'required|string|max:2',
                'cep' => 'required|string|max:10',
            ]);

            DB::beginTransaction();
            $empresa = Empresa::create($validatedData);

            DB::commit();
            Sweetalert::success('Empresa criada com sucesso!', 'Sucesso');
            return redirect()->route('empresas.index')->with('success', 'Empresa criada com sucesso!');
        } catch (\Exception $e) {
            dd($e->getMessage());
            DB::rollBack();
            Sweetalert::error('Empresa criada com sucesso!', 'Erro');
            return redirect()->back()->withInput()->withErrors('error', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Empresa $empresa)
    {
        return view('config.show', compact('empresa'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Empresa $empresa)
    {
        return view('config.form', compact('empresa'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Empresa $empresa)
    {
        try {
            // dd($request);
            $validatedData = $request->validate([
                'cnpj' => 'required|unique:empresas,cnpj,' . $empresa->id,
                'ie' => 'nullable|string|max:20',
                'razao_social' => 'required|string|max:255',
                'nome_fantasia' => 'nullable|string|max:255',
                'status' => 'required|in:ativo,inativo',
                'data_vencimento' => 'nullable|date',
                'cliente_desde' => 'nullable|date',
                'path_logo' => 'nullable|string|max:255',
                'logradouro' => 'nullable|string|max:255',
                'numero' => 'nullable|string|max:20',
                'bairro' => 'nullable|string|max:100',
                'cidade' => 'nullable|string|max:100',
                'estado' => 'nullable|string|max:2',
                'cep' => 'nullable|string|max:10',
            ]);

            DB::beginTransaction();

            $empresa->update($validatedData);

            DB::commit();
            Sweetalert::success('Empresa atualizada com sucesso!', 'Sucesso');
            return redirect()->route('empresas.index')->with('success', 'Empresa atualizada com sucesso!');
            
        } catch (\Exception $e) {
            DB::rollBack();
            dd($e->getMessage());
            Sweetalert::error('Erro ao atualizar a empresa!', 'Erro');
            return redirect()->back()->withInput()->withErrors('error', $e->getMessage());
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Empresa $empresa)
    {
        $empresa->delete();
        Sweetalert::success('Empresa deletada com sucesso!', 'Sucesso');
        return redirect()->route('empresas.index')->with('success', 'Empresa deletada com sucesso!');
    }

    public function getcompany()
    {
        $empresa = Empresa::where('id', Auth::user()->empresa_id)->get();
        return view('company.index', compact('empresa'));
    }

    public function updateCompany(Request $request)
    {
        try {
            $empresa = Empresa::find($request->id);
            $validatedData = $request->validate([
                'cnpj' => 'required|unique:empresas,cnpj,' . $request->id,
                'ie' => 'nullable|string|max:20',
                'razao_social' => 'required|string|max:255',
                'nome_fantasia' => 'nullable|string|max:255',
                'status' => 'required|in:ativo,inativo',
                'data_vencimento' => 'nullable|date',
                'cliente_desde' => 'nullable|date',
                'path_logo' => 'nullable|string|max:255',
                'logradouro' => 'nullable|string|max:255',
                'numero' => 'nullable|string|max:20',
                'bairro' => 'nullable|string|max:100',
                'cidade' => 'nullable|string|max:100',
                'estado' => 'nullable|string|max:2',
                'cep' => 'nullable|string|max:10',
            ]);

            DB::beginTransaction();

            $empresa->update($validatedData);

            DB::commit();
            Sweetalert::success('Empresa atualizada com sucesso!', 'Sucesso');
            return redirect()->route('company')->with('success', 'Dados da empresa atualizada com sucesso!');
            
        } catch (\Exception $e) {
            DB::rollBack();
            dd($e->getMessage());
            Sweetalert::error('Erro ao atualizar a empresa!', 'Erro');
            return redirect()->back()->withInput()->withErrors('error', $e->getMessage());
        }
    }

}
