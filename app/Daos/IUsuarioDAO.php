<?php

namespace App\Daos;

interface IUsuarioDAO extends IGenericDAO
{
    public function getByFilters($filters);
}
