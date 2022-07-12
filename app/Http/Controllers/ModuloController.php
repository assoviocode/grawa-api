<?php

namespace App\Http\Controllers;

use App\Models\Modulo;
use App\Services\ModuloService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class ModuloController extends Controller
{
    private $moduloService;

    public function __construct(ModuloService $moduloService)
    {
        $this->moduloService = $moduloService;
    }

    public function index()
    {
        $modulo = $this->moduloService->getAll();
        return response()->json($modulo, 200);
    }

    public function show($id)
    {
        try {
            $intId = intval($id);
        } catch (\Exception $e) {
            return $this->returnBadRequest();
        }

        $modulo = $this->moduloService->get($intId);

        if (is_null($modulo)) {
            return $this->returnNotFound();
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

    public function update(Request $request, int $id)
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
