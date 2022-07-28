<?php

namespace App\Daos;

interface ITarefaDAO extends IGenericDAO
{
    public function getByFilters($filters);

}
