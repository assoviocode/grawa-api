<?php

namespace App\Services;

use App\Daos\IUsuarioDAO;

class UsuarioService extends GenericCrudService
{

    public function __construct(IUsuarioDAO $usuarioDAO)
    {
        $this->dao = $usuarioDAO;
    }
}
