<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DateTimeInterface;

class Projeto extends Model
{
    use SoftDeletes;

    protected $primaryKey = 'id';
    protected $table = 'projeto';
    public $timestamps = true;

    protected $fillable = [
        'nome', 'descricao', 'status', 'cliente_id'
    ];

    protected $hidden = [
    ];

    protected function serializeDate(DateTimeInterface $date): string
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function modulos()
    {
        return $this->hasMany(Modulo::class);
    }

    public function tarefas()
    {
        return $this->hasManyThrough(Tarefa::class, Modulo::class);
    }
}
