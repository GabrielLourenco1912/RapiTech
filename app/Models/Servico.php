<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Servico extends Model
{
    use softDeletes;

    protected $table = 'servicos';

    protected $fillable =
        [
            'titulo',
            'descricao',
            'valor',
            'path_relatorio',
            'dev_id',
            'cliente_id',
            'proposta_id',
            'status_id',
            'pagamento_id',
        ];

    public function dev()
    {
        return $this->belongsTo(User::class, 'dev_id');
    }
    public function cliente()
    {
        return $this->belongsTo(User::class, 'cliente_id');
    }
    public function status()
    {
        return $this->belongsTo(Status::class, 'status_id');
    }
    public function escopo()
    {
        return $this->belongsToMany(Escopo::class, 'escopo_proposta');
    }
    public function proposta()
    {
        return $this->belongsTo(Proposta::class, 'proposta_id');
    }
    public function pagamento()
    {
        return $this->belongsTo(Pagamento::class, 'pagamento_id');
    }
}
