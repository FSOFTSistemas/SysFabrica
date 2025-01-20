<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{

    use HasFactory;

    protected $fillable = [
        'descricao',
        'precocusto',
        'precoVenda',
        'comissao',
        'insumo',
        'status',
        'empresa_id',
    ];

    public function empresa()
    {
        return $this->belongsTo(Empresa::class);
    }

    const STATUS_ATIVO = 'ativo';
    const STATUS_INATIVO = 'inativo';

    const INSUMO_SIM = 'sim';
    const INSUMO_NAO = 'nao';

    public function scopeAtivos($query)
    {
        return $query->where('status', self::STATUS_ATIVO);
    }

    public function getStatusAttribute($value)
    {
        return ucfirst($value);
    }

    public function getInsumoAttribute($value)
    {
        return ucfirst($value);
    }
    public function scopeDaEmpresa($query, $empresaId)
    {
        return $query->where('empresa_id', $empresaId);
    }

    public function receitas()
    {
        return $this->hasMany(Receita::class, 'produto_id');
    }

    public function ingredientes()
    {
        return $this->hasMany(Receita::class, 'ingrediente_id');
    }
}
