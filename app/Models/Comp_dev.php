<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comp_dev extends Model
{
    use softDeletes;

    protected $table = 'comp_devs';

    protected $fillable =
    [
        'user_id',
        'path_portfolio',
        'escopo_id',
    ];

    public function escopo()
    {
        return $this->belongsToMany(Escopo::class, 'escopo_comp_dev');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
