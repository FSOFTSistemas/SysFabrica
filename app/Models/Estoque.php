<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estoque extends Model
{
    use HasFactory;

    protected $fillable = [
        'estoque_atual',
        'entradas',
        'saidas',
        'produto_id',
        'empresa_id',
    ];

    public function produto()
    {
        return $this->belongsTo(Produto::class);
    }

    public function empresa()
    {
        return $this->belongsTo(Empresa::class);
    }
}
