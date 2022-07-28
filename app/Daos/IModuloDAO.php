<?php

namespace App\Daos;

interface IModuloDAO extends IGenericDAO
{
    public function getByFilters($filters);

    public function getByProjetoId($idModulo, $idProjeto);
}
