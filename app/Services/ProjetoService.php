<?php

namespace App\Services;

use App\Daos\IProjetoDAO;

class ProjetoService extends GenericCrudService
{

    public function __construct(IProjetoDAO $projetoDAO)
    {
        $this->dao = $projetoDAO;
    }
}
