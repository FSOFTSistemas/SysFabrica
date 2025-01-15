<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class EmpresaEnderecoUsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $permissions = [
            'manager_companies',
            'criar produto',
            'editar produto',
            'visualizar produto',
            'criar users',
            'editar users',
            'visualizar_dashboard',
            'visualizar cliente',
            'editar cliente',
            'criar cliente',
            'visualizar estoque',
            'criar estoque',
            'editar estoque',
            'visualizar funcionario',
            'editar funcionario',
            'criar funcionario',
            'visualizar venda',
            'editar venda',
            'criar venda',
            'visualizar producao',
            'editar producao',
            'criar producao',
            'visualizar usuario',
            'editar usuario',
            'criar usuario',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        $empresaId = DB::table('empresas')->insertGetId([
            'cnpj' => '42.879.649/0001-74',
            'ie' => '123456789',
            'razao_social' => 'Jose Luciano A. de Carvalho',
            'nome_fantasia' => 'FSOFT SISTEMAS',
            'status' => 'ativo',
            'data_vencimento' => now()->addMonth(),
            'cliente_desde' => now(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $userId = DB::table('users')->insert([
            'name' => 'Administrador',
            'email' => 'admin@fsoftsistemas.com',
            'password' => Hash::make('senha123'),
            'empresa_id' => $empresaId,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $adminRole = Role::firstOrCreate(['name' => 'fsoft']);
        $adminRole->syncPermissions($permissions);

        $user = User::find($userId);
        $user->assignRole($adminRole);

        foreach ($permissions as $permission) {
            $user->givePermissionTo($permission); 
        }
    }
}
