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
        'endereco_id',
        'status',
        'data_vencimento',
        'cliente_desde',
        'path_logo',
    ];

    /**
     * Definindo o relacionamento com a tabela de Endereços.
     */
    public function endereco()
    {
        return $this->belongsTo(Endereco::class);
    }
}
