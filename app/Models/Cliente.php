<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    protected $fillable = [
        'razaoSocial',
        'empresa_id',
        'nomeFantasia',
        'cnpj',
        'cpf',
        'ie',
        'telefone',
        'endereco',
    ];

    public function empresa()
    {
        return $this->belongsTo(Empresa::class);
    }

    public function vendas()
    {
        return $this->hasMany(Venda::class);
    }
}
