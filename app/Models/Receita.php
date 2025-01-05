<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Receita extends Model
{
    use HasFactory;

    protected $fillable = [
        'descricao',
        'qtd',
        'produto_id',
    ];

    /**
     * Relacionamento com o modelo Produto
     */
    public function produto()
    {
        return $this->belongsTo(Produto::class);
    }
}
