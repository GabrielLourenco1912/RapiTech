<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Notificacao extends Model
{
    use softDeletes;

    protected $table = 'notificacaos';

    protected $casts = [
        'read_at' => 'datetime',
    ];

    protected $fillable =
        [
            'titulo',
            'proposta_id',
            'status_id',
            'read_at',
            'destinatario_id',
            'descricao',
        ];

    public function proposta()
    {
        return $this->belongsTo(Servico::class);
    }
    public function destinatario()
    {
        return $this->belongsTo(User::class, 'destinatario_id');
    }
    public function enviador()
    {
        return $this->belongsTo(User::class, 'enviador_id');
    }
}
