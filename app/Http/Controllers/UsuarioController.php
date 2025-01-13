<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Wavey\Sweetalert\Sweetalert;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $usuarios = User::where('empresa_id', Auth::user()->empresa_id)->get();
        $permissions = Permission::all(); // Obter todas as permissões
        return view('usuarios.index', compact('usuarios', 'permissions'));
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
        try {
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|min:6',
                'permissions' => 'array',
            ]);
    
            $user = User::create([
                'name' => $validatedData['name'],
                'email' => $validatedData['email'],
                'password' => Hash::make($validatedData['password']),
            ]);
    
            if ($request->has('permissions')) {
                $user->syncPermissions($validatedData['permissions']);
            }
    
            Sweetalert::success('Usuário criado com sucesso!', 'Sucesso');
            return redirect()->route('usuarios.index');
        } catch (\Exception $e) {
            SweetAlert::error('Falha ao criar usuário! ' . $e->getMessage(), 'Erro');
            return redirect()->back()->withInput()->withErrors($e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $usuario)
    {
        try {
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email,' . $usuario->id,
                'password' => 'nullable|min:6',
                'permissions' => 'array',
            ]);
    
            $usuario->update([
                'name' => $validatedData['name'],
                'email' => $validatedData['email'],
                'password' => $request->filled('password') ? Hash::make($validatedData['password']) : $usuario->password,
            ]);
    
            if ($request->has('permissions')) {
                $usuario->syncPermissions($validatedData['permissions']);
            }
    
            SweetAlert::success('Usuário atualizado com sucesso!', 'Sucesso');
            return redirect()->route('usuarios.index');
        } catch (\Exception $e) {
            SweetAlert::error('Falha ao atualizar usuário! ' . $e->getMessage(), 'Erro');
            return redirect()->back()->withInput()->withErrors($e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $usuario)
    {
        try {
            $usuario->delete();
            SweetAlert::success('Usuário deletado com sucesso!', 'Sucesso');
            return redirect()->route('usuarios.index');
        } catch (\Exception $e) {
            SweetAlert::error('Falha ao deletar usuário! ' . $e->getMessage(), 'Erro');
            return redirect()->back()->withInput()->withErrors($e->getMessage());
        }
    }
    
}
