<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notificacao extends Model
{
    use softDeletes;

    protected $table = 'notificacaoss';

    protected $fillable =
        [
            'titulo',
            'enviador_id',
            'proposta_id',
            'status_is'.
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
