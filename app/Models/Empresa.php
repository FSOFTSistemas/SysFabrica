<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    use HasFactory;

    protected $fillable = [
        'cnpj',
        'ie',
        'razao_social',
        'nome_fantasia',
        'status',
        'data_vencimento',
        'cliente_desde',
        'path_logo',
        'logradouro',
        'numero',
        'bairro',
        'cidade',
        'estado',
        'cep',
    ];
}
