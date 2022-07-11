<?php

namespace App\Daos\Eloquent;

use App\Daos\IUsuarioDAO;
use App\Models\Usuario;

class UsuarioDAO extends GenericDAO implements IUsuarioDAO
{

    public function __construct()
    {
        $this->classModel = Usuario::class;
    }

}
