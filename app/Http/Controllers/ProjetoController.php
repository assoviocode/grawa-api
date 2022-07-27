<?php

namespace App\Http\Controllers;

use App\Models\Projeto;
use App\Services\ProjetoService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class ProjetoController extends Controller
{
    private $projetoService;

    public function __construct(ProjetoService $projetoService)
    {
        $this->projetoService = $projetoService;
    }

    public function index(Request $request)
    {
        $filters = array();

        if (!empty($request->input('nome')))
            $filters["nome"] = $request->input('nome');

        if (!empty($request->input('status')))
            $filters["status"] = $request->input('status');

        $projeto = $this->projetoService->getByFilters($filters);
        return response()->json($projeto, 200);
    }

    public function show($id)
    {
        try {
            $intId = intval($id);
        } catch (\Exception $e) {
            return $this->returnBadRequest();
        }

        $projeto = $this->projetoService->get($intId);

        if (is_null($projeto)) {
            return $this->returnNotFound();
        }
        // $projeto->load('cliente');

        return response()->json($projeto);
    }

    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'nome' => 'required',
                'status' => 'required',
                'cliente_id' => 'required',
            ],
            [
                'required' => ':attribute é obrigatório',
            ]
        );

        if ($validator->fails()) {
            return response()->json(['message' => ucfirst($validator->errors()->first())], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $projeto = new Projeto();
        $projeto->fill($request->all());

        $projeto = $this->projetoService->save($projeto);
        return response()->json($projeto, 201);
    }

    public function update(Request $request, int $id)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'nome' => 'required',
                'status' => 'required',
                'cliente_id' => 'required',
            ],
            [
                'required' => ':attribute é obrigatório',
            ]
        );

        if ($validator->fails()) {
            return response()->json(['message' => ucfirst($validator->errors()->first())], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $projeto = $this->projetoService->get($id);

        if ($projeto == null) {
            return $this->returnNotFound();
        }

        $projeto->fill($request->all());

        $projeto = $this->projetoService->save($projeto);

        return response()->json($projeto, 200);
    }

    public function destroy(int $id)
    {
        try {
            $intId = intval($id);
        } catch (\Exception $e) {
            return $this->returnBadRequest();
        }

        $projeto = $this->projetoService->get($id);

        if (is_null($projeto)) {
            return $this->returnBadRequest();
        }

        $this->projetoService->destroy($intId);

        return response()->json(null, 200);
    }
}
