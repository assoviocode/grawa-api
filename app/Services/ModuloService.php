<?php

namespace App\Services;

use App\Daos\IModuloDAO;

class ModuloService extends GenericCrudService
{

    public function __construct(IModuloDAO $moduloDAO)
    {
        $this->dao = $moduloDAO;
    }
}
