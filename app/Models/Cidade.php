<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cidade extends Model
{
    public $timestamps = false;
    protected $table = 'cidade';
    protected $primaryKey = 'id';

    protected $fillable = [
        'nome', 'uf'
    ];
}
