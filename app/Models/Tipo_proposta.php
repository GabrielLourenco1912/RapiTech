<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tipo_proposta extends Model
{
    protected $table = 'tipo_propostas';

    protected $fillable =
        [
            'nome',
        ];
    public function proposta()
    {
        return $this->hasMany(Proposta::class);
    }
}
