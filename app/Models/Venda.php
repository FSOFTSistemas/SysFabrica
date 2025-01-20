<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venda extends Model
{
    use HasFactory;

    protected $fillable = [
        'cliente_id',
        'data',
        'empresa_id',
        'total',
        'desconto',
        'acrescimo',
        'forma_pagamento_id',
        'status',
        'obs',
        'usuario_id',
    ];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    public function empresa()
    {
        return $this->belongsTo(Empresa::class);
    }

    public function usuario()
    {
        return $this->belongsTo(User::class);
    }

    public function formaPagamento()
    {
        return $this->belongsTo(formaPagamento::class, 'forma_pagamento_id');
    }

    public function itensVenda()
    {
        return $this->hasMany(ItemVenda::class);
    }

    public function scopeDaEmpresa($query, $empresaId)
    {
        return $query->where('empresa_id', $empresaId);
    }
}
