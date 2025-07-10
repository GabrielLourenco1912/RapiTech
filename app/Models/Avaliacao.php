<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Avaliacao extends Model
{
    use softDeletes;

    protected $table = 'avaliacaos';

    protected $fillable =
        [
            'titulo',
            'enviador_id',
            'servico_id',
            'destinatario_id',
            'descricao',
        ];

    public function servico()
    {
        return $this->belongsTo(Servico::class, 'servico_id');
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
