<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormaPagamento extends Model
{
    use HasFactory;

    protected $fillable = [
        'descricao',
    ];

    public function vendas()
    {
        return $this->hasMany(Venda::class, 'forma_pagamento_id');
    }
}
