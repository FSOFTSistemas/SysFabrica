<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Endereco extends Model
{
    use HasFactory;

    protected $fillable = [
        'logradouro',
        'numero',
        'bairro',
        'cidade',
        'estado',
        'cep',
        'ibge',
        'empresa_id',
    ];

    /**
     * Definindo o relacionamento com a tabela de Empresas.
     */
    public function empresas()
    {
        return $this->hasMany(Empresa::class);
    }

    public function scopeDaEmpresa($query, $empresaId)
    {
        return $query->where('empresa_id', $empresaId);
    }
}
