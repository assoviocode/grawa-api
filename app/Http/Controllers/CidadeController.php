<?php

namespace App\Http\Controllers;

use App\Services\CidadeService;

class CidadeController extends Controller
{
    private $cidadeService;

    public function __construct(CidadeService $cidadeService)
    {
        $this->cidadeService = $cidadeService;
    }

    public function index()
    {
        $cidades = $this->cidadeService->getAll();
        return response()->json($cidades, 200);
    }

    public function show($id)
    {
        try {
            $intId = intval($id);
        } catch (\Exception $e) {
            return $this->returnBadRequest();
        }

        $cidade = $this->cidadeService->get($intId);

        if (is_null($cidade)) {
            return $this->returnNotFound();
        }

        return response()->json($cidade);
    }
}
