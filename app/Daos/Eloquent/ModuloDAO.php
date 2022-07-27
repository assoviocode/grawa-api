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

    public function getByFilters($filters, $paginate = true)
    {
        $query = app($this->classModel)->newQuery();

        if (!empty($filters["nome"])) {
            $query->where("nome", "like", "%" . $filters["nome"] . "%");
        }

        if (!empty($filters["status"])) {
            $query->where("status", "like", "%" . $filters["status"] . "%");
        }

        if ($paginate) {
            return  $query->paginate(30);
        }

        return  $query->get();
    }
}
