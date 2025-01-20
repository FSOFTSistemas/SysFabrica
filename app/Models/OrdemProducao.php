<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrdemProducao extends Model
{
    use HasFactory;

    protected $fillable = [
        'funcionario_id',
        'produto_id',
        'valor_unitario',
        'producao_estimada',
        'producao_real',
        'status',
        'empresa_id',
    ];

    public function funcionario()
    {
        return $this->belongsTo(Funcionario::class);
    }

    public function produto()
    {
        return $this->belongsTo(Produto::class);
    }

    public function empresa()
    {
        return $this->belongsTo(Empresa::class);
    }

    public function scopeDaEmpresa($query, $empresaId)
    {
        return $query->where('empresa_id', $empresaId);
    }
}
