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

    public function getByFilters($filters, $paginate = true)
    {
        $query = app($this->classModel)->newQuery();

        if (!empty($filters["nome"])) {
            $query->where("nome", "like", "%" . $filters["nome"] . "%");
        }

        if ($paginate) {
            return  $query->paginate(30);
        }

        return  $query->get();
    }
}
