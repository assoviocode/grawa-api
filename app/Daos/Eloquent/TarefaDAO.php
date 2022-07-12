<?php

namespace App\Daos\Eloquent;

use App\Daos\ITarefaDAO;
use App\Models\Tarefa;

class TarefaDAO extends GenericDAO implements ITarefaDAO
{

    public function __construct()
    {
        $this->classModel = Tarefa::class;
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
