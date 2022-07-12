<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DateTimeInterface;


class Modulo extends Model
{
    use SoftDeletes;

    protected $primaryKey = 'id';
    protected $table = 'modulo';
    public $timestamps = true;

    protected $fillable = [
        'nome', 'descricao', 'projeto_id'
    ];

    protected $hidden = [];

    protected function serializeDate(DateTimeInterface $date): string
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function tarefas()
    {
        return $this->hasMany(Tarefa::class);
    }
}
