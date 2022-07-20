<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cliente extends Model
{
    use SoftDeletes;  /*DELETE LÓGICO*/

    protected $primaryKey = 'id';
    protected $table = 'cliente';
    public $timestamps = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'nome', 'cnpj', 'razao_social', 'telefone', 'endereco' , 'responsavel_nome', 'responsavel_cpf', 'responsavel_telefone', 'responsavel_email'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var string[]
     */
    protected $hidden = [
        'senha',
    ];

    protected function serializeDate(DateTimeInterface $date): string
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function endereco()
    {
        return $this->hasOne(Endereco::class);
    }
}
