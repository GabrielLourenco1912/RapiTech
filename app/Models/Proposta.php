<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Proposta extends Model
{
    use softDeletes;

    protected $fillable =
        [
            'solicitante_id',
            'recebedor_id',
            'enviador_id',
            'titulo',
            'descricao',
            'valor',
            'tipo_id',
            'status_id',
        ];

    public function solicitante()
    {
        return $this->belongsTo(User::class, 'solicitante_id');
    }
    public function recebedor()
    {
        return $this->belongsTo(User::class, 'recebedor_id');
    }
    public function enviador()
    {
        return $this->belongsTo(User::class, 'enviador_id');
    }
    public function tipo()
    {
        return $this->belongsTo(Tipo_proposta::class, 'tipo_id');
    }
    public function status()
    {
        return $this->belongsTo(Status::class, 'status_id');
    }
    public function escopo()
    {
        return $this->belongsToMany(Escopo::class, 'escopo_proposta');
    }
    public function servico()
    {
        return $this->hasOne(Servico::class);
    }
}
