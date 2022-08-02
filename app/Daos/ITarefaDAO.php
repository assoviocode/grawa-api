<?php

namespace App\Daos;

interface ITarefaDAO extends IGenericDAO
{
    public function getByFilters($filters);

    public function getByProjetoId($idTarefa, $idProjeto);

    public function getByModuloId($idTarefa, $idModulo);

}
