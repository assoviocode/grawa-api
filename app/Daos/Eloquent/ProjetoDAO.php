<?php

namespace App\Daos\Eloquent;

use App\Daos\IProjetoDAO;
use App\Models\Projeto;

class ProjetoDAO extends GenericDAO implements IProjetoDAO
{

    public function __construct()
    {
        $this->classModel = Projeto::class;
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
