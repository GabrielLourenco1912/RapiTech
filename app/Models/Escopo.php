<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Escopo extends Model
{
    use softDeletes;

    protected $table = 'escopos';

    protected $fillable =
        [
            'nome',
        ];

    public function proposta()
    {
        return $this->belongsToMany(Proposta::class, 'escopo_proposta');
    }
    public function comp_dev()
    {
        return $this->belongsToMany(Comp_dev::class, 'escopo_comp_dev');
    }
    public function servico()
    {
        return $this->belongsToMany(Servico::class, 'escopo_servico');
    }
}
