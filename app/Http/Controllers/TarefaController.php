<?php

namespace App\Http\Controllers;

use App\Models\Tarefa;
use App\Services\TarefaService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class TarefaController extends Controller
{
    private $tarefaService;

    public function __construct(TarefaService $tarefaService)
    {
        $this->tarefaService = $tarefaService;
    }

    public function index(Request $request)
    {
        $filters = array();

        if (!empty($request->input('nome')))
            $filters["nome"] = $request->input('nome');

        if (!empty($request->input('status')))
            $filters["status"] = $request->input('status');

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

    public function destroy(int $id)
    {
        try {
            $intId = intval($id);
        } catch (\Exception $e) {
            return $this->returnBadRequest();
        }

        $tarefa = $this->tarefaService->get($id);

        if (is_null($tarefa)) {
            return $this->returnBadRequest();
        }

        $this->tarefaService->destroy($intId);

        return response()->json(null, 200);
    }
}
