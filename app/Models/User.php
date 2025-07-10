<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, softDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id',
        'path_foto',
        'descricao',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function comp_dev()
    {
        return $this->hasOne(Comp_dev::class);
    }

    public function comp_cliente()
    {
        return $this -> hasOne(Comp_cliente::class);
    }
    public function avaliacoes_enviadas()
    {
        return $this->hasMany(Avaliacao::class, 'enviador_id');
    }
    public function avaliacoes_recebidas()
    {
        return $this->hasMany(Avaliacao::class, 'destinatario_id');
    }
    public function propostas_enviadas()
    {
        return $this->hasMany(Proposta::class, 'enviador_id');
    }
    public function propostas_recebidas()
    {
        return $this->hasMany(Proposta::class, 'destinatario_id');
    }
    public function notificacao()
    {
        return $this->hasMany(Notificacao::class);
    }
    public function servico_dev()
    {
        return $this->hasMany(Servico::class, 'dev_id');
    }
    public function servico_cliente()
    {
        return $this->hasMany(Servico::class, 'cliente_id');
    }
    public function pagamentos_recebidos()
    {
        return $this->hasMany(Pagamento::class, 'recebedor_id');
    }
    public function pagamentos_realizados()
    {
        return $this->hasMany(Pagamento::class, 'pagador_id');
    }

}
