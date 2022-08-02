<?php

namespace App\Http\Controllers;

use App\Models\Tarefa;
use App\Services\TarefaService;
use App\Services\ProjetoService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class TarefaController extends Controller
{
    private $tarefaService;
    private $projetoService;

    public function __construct(TarefaService $tarefaService, ProjetoService $projetoService)
    {
        $this->tarefaService = $tarefaService;
        $this->projetoService = $projetoService;
    }

    public function index(Request $request)
    {
        $filters = array();

        if (!empty($request->input('nome')))
            $filters["nome"] = $request->input('nome');


        $tarefa = $this->tarefaService->getByFilters($filters);
        return response()->json($tarefa, 200);
    }

    public function show($id)
    {
        try {
            $intId = intval($id);
        } catch (\Exception $e) {
            return $this->returnBadRequest();
        }

        $tarefa = $this->tarefaService->get($intId);

        if (is_null($tarefa)) {
            return $this->returnNotFound();
        }

        return response()->json($tarefa);
    }

    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'nome' => 'required',
                'status' => 'required',
                'responsavel_id' => 'required',
            ],
            [
                'required' => ':attribute é obrigatório',
            ]
        );

        if ($validator->fails()) {
            return response()->json(['message' => ucfirst($validator->errors()->first())], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $tarefa = new tarefa();
        $tarefa->fill($request->all());

        $tarefa = $this->tarefaService->save($tarefa);
        return response()->json($tarefa, 201);
    }

    public function update(Request $request, int $id)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'nome' => 'required',
                'status' => 'required',
                'responsavel_id' => 'required',
            ],
            [
                'required' => ':attribute é obrigatório',
            ]
        );

        if ($validator->fails()) {
            return response()->json(['message' => ucfirst($validator->errors()->first())], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $tarefa = $this->tarefaService->get($id);

        if ($tarefa == null) {
            return $this->returnNotFound();
        }

        $tarefa->fill($request->all());

        $tarefa = $this->tarefaService->save($tarefa);

        return response()->json($tarefa, 200);
    }

    public function destroy($id, $idProjeto)
    {
        $idProjeto = intval($idProjeto);
        $idTarefa = intval($id);

        if ($idProjeto == 0 || $idTarefa == 0) {
            return response()->json('', Response::HTTP_BAD_REQUEST);
        }

        $projeto = $this->projetoService->get($idProjeto);

        if (is_null($projeto)) {
            return response()->json('', Response::HTTP_NOT_FOUND);
        }

        $tarefa = $this->tarefaService->getByProjetoId($idTarefa, $idProjeto);

        if (is_null($tarefa)) {
            return $this->returnBadRequest();
        }

        $this->tarefaService->destroy($idTarefa);

        return response()->json(null, 200);
    }
}
