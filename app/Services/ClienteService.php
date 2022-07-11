<?php

namespace App\Services;

use App\Daos\IClienteDAO;

class ClienteService extends GenericCrudService
{

    public function __construct(IClienteDAO $clienteDAO)
    {
        $this->dao = $clienteDAO;
    }
}
