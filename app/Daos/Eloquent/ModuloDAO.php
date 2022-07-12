<?php

namespace App\Daos\Eloquent;

use App\Daos\IModuloDAO;
use App\Models\Modulo;

class ModuloDAO extends GenericDAO implements IModuloDAO
{

    public function __construct()
    {
        $this->classModel = Modulo::class;
    }
}
