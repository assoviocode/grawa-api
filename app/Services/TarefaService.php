<?php

namespace App\Services;

use App\Daos\ITarefaDAO;

class TarefaService extends GenericCrudService
{

    public function __construct(ITarefaDAO $tarefaDAO)
    {
        $this->dao = $tarefaDAO;
    }

    public function getByModuloId($idTarefa, $idModulo)
    {
        return $this->dao->getByModuloId($idTarefa, $idModulo);
    }

    public function getByProjetoId($idTarefa, $idProjeto)
    {
        return $this->dao->getByProjetoId($idTarefa, $idProjeto);
    }

}
