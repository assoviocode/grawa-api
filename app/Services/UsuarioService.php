<?php

namespace App\Services;

use App\Daos\IUsuarioDAO;
use App\Models\Usuario;

class UsuarioService extends GenericCrudService
{

    public function __construct(IUsuarioDAO $usuarioDAO)
    {
        $this->dao = $usuarioDAO;
    }

    public function save($usuario): Usuario
    {
        $novo = $usuario->id == null;

        if ($novo) {
            $usuario->encryptPassword();
        }

        $this->dao->save($usuario);

        return $usuario;
    }
}
