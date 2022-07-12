<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Endereco extends Model
{

    public $timestamps = false;
    protected $table = 'endereco';
    protected $primaryKey = 'id';

    protected $attributes = [
        'complemento' => '',
    ];

    protected $fillable = [
        'cep', 'logradouro', 'numero', 'complemento', 'bairro', 'localidade', 'uf'
    ];

    protected $hidden = [
        'id', 'cliente_id'
    ];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

}