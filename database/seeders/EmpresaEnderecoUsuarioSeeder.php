<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class EmpresaEnderecoUsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $enderecoId = DB::table('enderecos')->insertGetId([
            'logradouro' => 'Rua Dom Luiz de Brito',
            'numero' => '53',
            'bairro' => 'Centro',
            'cidade' => 'Garanhuns',
            'estado' => 'PE',
            'cep' => '55295-050',
            'ibge' => '2606002',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $empresaId = DB::table('empresas')->insertGetId([
            'cnpj' => '42.879.649/0001-74',
            'ie' => '123456789',
            'razao_social' => 'Jose Luciano A. de Carvalho',
            'nome_fantasia' => 'FSOFT SISTEMAS',
            'endereco_id' => $enderecoId,
            'status' => 'ativo',
            'data_vencimento' => now()->addMonth(),
            'cliente_desde' => now(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('users')->insert([
            'name' => 'Administrador',
            'email' => 'admin@fsoftsistemas.com',
            'password' => Hash::make('senha123'),
            'empresa_id' => $empresaId,
            'permissions' => 'admin',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
