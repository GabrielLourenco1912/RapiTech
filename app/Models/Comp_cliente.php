<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comp_cliente extends Model
{
    use softDeletes;

    protected $table = 'comp_clientes';

    protected $fillable =
        [
            'user_id',
            'endereco_cobranca',
        ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
