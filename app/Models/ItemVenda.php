<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemVenda extends Model
{
    use HasFactory;

    protected $fillable = [
        'produto_id',
        'venda_id',
        'qtde',
        'unitario',
        'desconto',
        'subtotal',
    ];

    public function produto()
    {
        return $this->belongsTo(Produto::class);
    }

    public function venda()
    {
        return $this->belongsTo(Venda::class);
    }

    public function scopeDaEmpresa($query, $empresaId)
    {
        return $query->where('empresa_id', $empresaId);
    }
}
