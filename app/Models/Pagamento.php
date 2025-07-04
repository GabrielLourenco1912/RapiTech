<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pagamento extends Model
{
    use softDeletes;

    protected $table = 'pagamentos';

    protected $fillable =
        [
            'pagador_id',
            'recebedor_id',
            'metodo_pagamento_id',
            'referencia',
            'valor',
            'status_id',
        ];

    public function metodo_pagamento()
    {
        return $this->belongsTo(Metodo_pagamento::class, 'metodo_pagamento_id');
    }
    public function pagador()
    {
        return $this->belongsTo(User::class, 'pagador_id');
    }
    public function recebedor()
    {
        return $this->belongsTo(User::class, 'recebedor_id');
    }
    public function status()
    {
        return $this->belongsTo(Status::class, 'status_id');
    }
    public function servico()
    {
        return $this->hasOne(Servico::class);
    }
}
