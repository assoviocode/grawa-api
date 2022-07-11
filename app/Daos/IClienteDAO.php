<?php

namespace App\Daos;

interface IClienteDAO extends IGenericDAO
{
    public function getByFilters($filters);
}
