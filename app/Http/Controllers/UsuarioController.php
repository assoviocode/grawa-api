<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use App\Services\UsuarioService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class UsuarioController extends Controller
{

    private $usuarioService;

    public function __construct(UsuarioService $usuarioService)
    {
        $this->usuarioService = $usuarioService;
    }

    public function index(Request $request)
    {
        $filters = array();

        if (!empty($request->input('nome')))
            $filters["nome"] = $request->input('nome');

        $usuarios = $this->usuarioService->getByFilters($filters);
        return response()->json($usuarios, 200);
    }

    public function show($id)
    {
        try {
            $intId = intval($id);
        } catch (\Exception $e) {
            return $this->returnBadRequest();
        }

        $usuario = $this->usuarioService->get($intId);

        if (is_null($usuario)) {
            return $this->returnNotFound();
        }

        return response()->json($usuario);
    }

    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'nome' => 'required',
                'email' => 'bail|required|email',
                'senha' => 'required|min:8',
            ],
            [
                'required' => ':attribute é obrigatório',
                'email' => ':attribute está com formato inválido',
            ]
        );

        if ($validator->fails()) {
            return response()->json(['message' => ucfirst($validator->errors()->first())], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $usuario = new Usuario();
        $usuario->fill($request->all());

        $usuario = $this->usuarioService->save($usuario);
        return response()->json($usuario, 201);
    }

    public function update(Request $request, int $id)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'nome' => 'required',
                'email' => 'bail|required|email',
            ],
            [
                'required' => ':attribute é obrigatório',
                'email' => ':attribute está com formato inválido',
            ]
        );

        if ($validator->fails()) {
            return response()->json(['message' => ucfirst($validator->errors()->first())], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $usuario = $this->usuarioService->get($id);

        if ($usuario == null) {
            return $this->returnNotFound();
        }

        $usuario->fill($request->all());

        $usuario = $this->usuarioService->save($usuario);

        return response()->json($usuario, 200);
    }

    public function destroy(int $id)
    {
        try {
            $intId = intval($id);
        } catch (\Exception $e) {
            return $this->returnBadRequest();
        }

        $usuario = $this->usuarioService->get($id);

        if (is_null($usuario)) {
            return $this->returnBadRequest();
        }

        $this->usuarioService->destroy($intId);

        return response()->json(null, 200);
    }
}
