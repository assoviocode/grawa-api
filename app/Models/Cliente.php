<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cliente extends Model
{
    use SoftDeletes;

    protected $primaryKey = 'id';
    protected $table = 'cliente';
    public $timestamps = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'nome', 'cnpj', 'razao_social', 'telefone', 'endereco', 'cidade_id', 'responsavel_nome', 'responsavel_cpf', 'responsavel_telefone', 'responsavel_email'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var string[]
     */
    protected $hidden = [
        'senha', 'cidade_id'
    ];

    public function endereco()
    {
        return $this->hasOne(Endereco::class);
    }
}
