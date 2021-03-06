<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DateTimeInterface;

class Tarefa extends Model
{
    use SoftDeletes;

    protected $primaryKey = 'id';
    protected $table = 'tarefa';
    public $timestamps = true;

    protected $fillable = [
        'nome', 'status', 'descricao', 'previsao', 'dt_previsao_inicio', 'dt_previsao_termino', 'dt_inicio', 'dt_termino', 'extra', 'responsavel_id', 'modulo_id',
    ];

    protected $hidden = [
        'laravel_through_key'
    ];

    protected function serializeDate(DateTimeInterface $date): string
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function modulo()
    {
        return $this->belongsTo(Modulo::class);
    }

    public function usuario()
    {
        return $this->hasOne(Usuario::class);
    }
}
