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

        DB::table('users')->insert([
            'name' => 'Administrador',
            'email' => 'admin@fsoftsistemas.com',
            'password' => Hash::make('senha123'),
            'permissions' => 'admin',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
