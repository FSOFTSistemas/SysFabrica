<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estoque extends Model
{
    use HasFactory;

    protected $fillable = [
        'produto_id',
        'estoque_atual',
        'entradas',
        'saidas',
    ];

    public function produto()
    {
        return $this->belongsTo(Produto::class);
    }
}
