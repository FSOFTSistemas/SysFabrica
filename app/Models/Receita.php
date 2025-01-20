<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Receita extends Model
{
    use HasFactory;

    protected $fillable = [
        'qtd',
        'produto_id',
        'ingrediente_id',
    ];

    /**
     * Relacionamento com o modelo Produto
     */

    public function scopeDaEmpresa($query, $empresaId)
    {
        return $query->where('empresa_id', $empresaId);
    }
    public function produto()
    {
        return $this->belongsTo(Produto::class, 'produto_id');
    }

    public function ingrediente()
    {
        return $this->belongsTo(Produto::class, 'ingrediente_id');
    }
}
