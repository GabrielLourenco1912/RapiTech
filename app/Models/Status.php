<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    protected $table = 'status';

    protected $fillable =
        [
            'nome',
        ];

    public function servico()
    {
        return $this->hasMany(Servico::class);
    }
    public function proposta()
    {
        return $this->hasMany(Proposta::class);
    }
}
