<?php

namespace App\Daos\Eloquent;

use App\Daos\IClienteDAO;
use App\Models\Cliente;

class ClienteDAO extends GenericDAO implements IClienteDAO
{

    public function __construct()
    {
        $this->classModel = Cliente::class;
    }

}
