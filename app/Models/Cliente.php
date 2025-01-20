<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    protected $fillable = [
        'razaoSocial',
        'nomeFantasia',
        'cnpj',
        'ie',
        'email',
        'telefone',
        'endereco_id',
        'empresa_id',
    ];

    public function empresa()
    {
        return $this->belongsTo(Empresa::class);
    }

    public function endereco()
    {
        return $this->belongsTo(Endereco::class);
    }

    public function vendas()
    {
        return $this->hasMany(Venda::class);
    }
    public function scopeDaEmpresa($query, $empresaId)
    {
        return $query->where('empresa_id', $empresaId);
    }
}
