<?php

namespace App\Http\Controllers;

use App\Models\Modulo;
use App\Models\Projeto;
use App\Services\ModuloService;
use App\Services\ProjetoService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class ModuloController extends Controller
{
    private $moduloService;
    private $projetoService;

    public function __construct(ModuloService $moduloService, ProjetoService $projetoService)
    {
        $this->moduloService = $moduloService;
        $this->projetoService = $projetoService;
    }

    public function index($idProjeto, Request $request)
    {
        try {
            $intId = intval($idProjeto);
        } catch (\Exception $e) {
            return response()->json('', Response::HTTP_BAD_REQUEST);
        }

        $projeto = $this->projetoService->get($intId);

        if (is_null($projeto)) {
            return response()->json('', Response::HTTP_NOT_FOUND);
        }

        $filters = array();

        if (!empty($request->input('nome')))
            $filters["nome"] = $request->input('nome');

        $filters["projeto_id"] = $projeto->id;

        $modulo = $this->moduloService->getByFilters($filters);
        return response()->json($modulo, 200);
    }

    public function show($id, $idProjeto)
    {

        $idProjeto = intval($idProjeto);
        $idModulo = intval($id);

        if ($idProjeto == 0 || $idModulo == 0) {
            return response()->json('', Response::HTTP_BAD_REQUEST);
        }

        $projeto = $this->projetoService->get($idProjeto);

        if (is_null($projeto)) {
            return response()->json('', Response::HTTP_NOT_FOUND);
        }

        $modulo = $this->moduloService->getByProjetoId($idModulo, $idProjeto);

        if (is_null($modulo)) {
            return response()->json('', Response::HTTP_NOT_FOUND);
        }

        return response()->json($modulo);
    }

    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'nome' => 'required',
            ],
            [
                'required' => ':attribute é obrigatório',
            ]
        );

        if ($validator->fails()) {
            return response()->json(['message' => ucfirst($validator->errors()->first())], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $modulo = new modulo();
        $modulo->fill($request->all());

        $modulo = $this->moduloService->save($modulo);
        return response()->json($modulo, 201);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'nome' => 'required',
            ],
            [
                'required' => ':attribute é obrigatório',
            ]
        );

        if ($validator->fails()) {
            return response()->json(['message' => ucfirst($validator->errors()->first())], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $modulo = $this->moduloService->get($id);

        if ($modulo == null) {
            return $this->returnNotFound();
        }

        $modulo->fill($request->all());

        $modulo = $this->moduloService->save($modulo);

        return response()->json($modulo, 200);
    }

    public function destroy(int $id)
    {
        try {
            $intId = intval($id);
        } catch (\Exception $e) {
            return $this->returnBadRequest();
        }

        $modulo = $this->moduloService->get($id);

        if (is_null($modulo)) {
            return $this->returnBadRequest();
        }

        $this->moduloService->destroy($intId);

        return response()->json(null, 200);
    }
}
