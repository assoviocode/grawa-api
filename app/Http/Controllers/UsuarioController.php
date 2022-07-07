<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class UsuarioController extends Controller
{

    public function __construct()
    {
    }

    public function index(Request $request)
    {
        // $nome = "";
        // $email = "";

        $usuario = new Usuario();
        $usuario->nome = "Teste";
        $usuario->email = "teste@email.com";

        if (!empty($request->input('nome')))
            $usuario->nome = $request->input('nome');

        if (!empty($request->input('email')))
            $usuario->email = $request->input('email');

        return response()->json([$usuario], 200);
    }

    public function show($id)
    {
        try {
            $intId = intval($id);
        } catch (\Exception $e) {
            return $this->returnBadRequest();
        }

        $usuario = new Usuario();
        $usuario->id = $id;
        $usuario->nome = "Teste";
        $usuario->email = "teste@email.com";


        // $usuario = $this->usuarioService->get($intId);

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

        // $usuario = $this->usuarioService->get($id);

        $usuario = new Usuario();
        $usuario->id = $id; /*APAGAR*/
        $usuario->fill($request->all());

        if ($usuario == null) {
            return $this->returnNotFound();
        }

        // return response()->json($usuario, 200);
        return response()->json(['message' => 'Usuario atualizado com sucesso'], 200);
    }
}
