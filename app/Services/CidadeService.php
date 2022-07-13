<?php

namespace App\Services;

use App\Daos\ICidadeDAO;

class CidadeService extends GenericCrudService
{

    public function __construct(ICidadeDAO $cidadeDAO)
    {
        $this->dao = $cidadeDAO;
    }
}
