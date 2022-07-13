<?php

namespace App\Daos\Eloquent;

use App\Daos\ICidadeDAO;
use App\Models\Cidade;

class CidadeDAO extends GenericDAO implements ICidadeDAO
{

    public function __construct()
    {
        $this->classModel = Cidade::class;
    }
}
