<?php

namespace App\Daos\Eloquent;

use App\Daos\IUsuarioDAO;
use App\Models\Usuario;

class UsuarioDAO extends GenericDAO implements IUsuarioDAO
{

    public function __construct()
    {
        $this->classModel = Usuario::class;
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
