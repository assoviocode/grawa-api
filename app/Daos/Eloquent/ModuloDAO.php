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

        if (!empty($filters["projeto_id"])) {
            $query->where("projeto_id", "like", "%" . $filters["projeto_id"] . "%");
        }

        if ($paginate) {
            return  $query->paginate(30);
        }

        return  $query->get();
    }

    public function getByProjetoId($idModulo, $idProjeto)
    {
        return $this->classModel::where('id', $idModulo)->where('projeto_id', $idProjeto)->first();
    }
}
