<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Metodo_pagamento extends Model
{
    protected $table = 'metodo_pagamentos';

    protected $fillable =
        [
            'nome',
        ];

    public function pagamento()
    {
        return $this->hasMany(Pagamento::class);
    }
}
