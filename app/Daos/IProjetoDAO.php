<?php

namespace App\Daos;

interface IProjetoDAO extends IGenericDAO
{
    public function getByFilters($filters);
}
