<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class ClienteController extends Controller
{

    public function __construct()
    {
    }

    public function index(Request $request)
    {
        // $nome = "Teste";
        // $email = "teste@email.com";

        $cliente = new Cliente();
        $cliente->nome = "Teste";
        $cliente->email = "teste@email.com";

        if (!empty($request->input('nome')))
            $nome = $request->input('nome');

        if (!empty($request->input('email')))
            $email = $request->input('email');

        return response()->json([$cliente], 200);
    }

    public function show($id)
    {
        try {
            $intId = intval($id);
        } catch (\Exception $e) {
            return $this->returnBadRequest();
        }

        $cliente = new Cliente();
        $cliente->id = $id;
        $cliente->nome = "Teste";
        $cliente->email = "teste@email.com";

        // $cliente = $this->clienteService->get($intId);

        if (is_null($cliente)) {
            return $this->returnNotFound();
        }

        return response()->json($cliente);
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

        $cliente = new Cliente();
        $cliente->fill($request->all());

        return response()->json($cliente, 201);
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

        // $cliente = $this->clienteService->get($id);

        $cliente = new Cliente();
        $cliente->id = $id; /*APAGAR*/
        $cliente->fill($request->all());

        if ($cliente == null) {
            return $this->returnNotFound();
        }

        $cliente->fill($request->all());

        // return response()->json([$cliente], 200);
        return response()->json(['message' => 'Cliente atualizado com sucesso'], 200);
    }
}
