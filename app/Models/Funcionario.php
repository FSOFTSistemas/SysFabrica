<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Funcionario extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'telefone',
        'comissao',
        'admissao',
        'situacao',
        'empresa_id',
        'endereco_id',
    ];

    public function empresa()
    {
        return $this->belongsTo(Empresa::class);
    }

    public function endereco()
    {
        return $this->belongsTo(Endereco::class);
    }
}
