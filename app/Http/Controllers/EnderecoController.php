<?php

namespace App\Http\Controllers;

use App\Models\Endereco;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Wavey\Sweetalert\Sweetalert;

class EnderecoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        $validatedData = $request->validate([
            'logradouro' => 'required|string|max:255',
            'numero' => 'required|string|max:50',
            'bairro' => 'required|string|max:100',
            'cidade' => 'required|string|max:100',
            'estado' => 'required|string|max:100',
            'cep' => 'required|string|max:20',
            'ibge' => 'required',
        ]);

        try {
            $validatedData['empresa_id'] = Auth::user()->empresa_id;
            $endereco = Endereco::create($validatedData);


            return response()->json([
                'success' => true,
                'endereco' => $endereco,
            ], 200); 
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erro ao salvar o endereço. Tente novamente.',
                'error' => $e->getMessage(),
            ], 500); 
        }
    }

    public function buscarEnderecoPorCep($cep)
    {
        try {
            $cep = preg_replace('/[^0-9]/', '', $cep);
    
            if (strlen($cep) !== 8) {
                return response()->json(['error' => 'CEP inválido.'], 400);
            }
    
            $response = Http::get("https://viacep.com.br/ws/{$cep}/json/");
    
            if ($response->failed()) {
                return response()->json(['error' => 'Não foi possível buscar o endereço.'], 500);
            }
            return $response->json();
        } catch (\Exception $e) {
            Sweetalert::error('Erro ao buscar endereco !', 'Error');
            redirect()->back()->withInput();
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(Endereco $endereco)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Endereco $endereco)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Endereco $endereco)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Endereco $endereco)
    {
        //
    }
}
