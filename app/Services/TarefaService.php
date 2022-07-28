<?php

namespace App\Services;

use App\Daos\ITarefaDAO;

class TarefaService extends GenericCrudService
{

    public function __construct(ITarefaDAO $tarefaDAO)
    {
        $this->dao = $tarefaDAO;
    }

}
