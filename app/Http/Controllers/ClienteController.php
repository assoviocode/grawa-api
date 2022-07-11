<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Services\ClienteService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class ClienteController extends Controller
{
    private $clienteService;

    public function __construct(ClienteService $clienteService)
    {
        $this->clienteService = $clienteService;
    }

    public function index()
    {
        $cliente = $this->clienteService->getAll();
        return response()->json($cliente, 200);
    }

    public function show($id)
    {
        try {
            $intId = intval($id);
        } catch (\Exception $e) {
            return $this->returnBadRequest();
        }

        $cliente = $this->clienteService->get($intId);

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
                'cnpj' => 'required',
                'razao_social' => 'required',
                'telefone' => 'required',
            ],
            [
                'required' => ':attribute é obrigatório',
            ]
        );

        if ($validator->fails()) {
            return response()->json(['message' => ucfirst($validator->errors()->first())], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $cliente = new Cliente();
        $cliente->fill($request->all());

        $cliente = $this->clienteService->save($cliente);
        return response()->json($cliente, 201);
    }

    public function update(Request $request, int $id)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'nome' => 'required',
                'cnpj' => 'required',
                'razao_social' => 'required',
                'telefone' => 'required',
                'cidade_id' => 'required',
            ],
            [
                'required' => ':attribute é obrigatório',
            ]
        );

        if ($validator->fails()) {
            return response()->json(['message' => ucfirst($validator->errors()->first())], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $cliente = $this->clienteService->get($id);

        if ($cliente == null) {
            return $this->returnNotFound();
        }

        $cliente->fill($request->all());

        $cliente = $this->clienteService->save($cliente);

        return response()->json($cliente, 200);
    }

    public function destroy(int $id)
    {
        try {
            $intId = intval($id);
        } catch (\Exception $e) {
            return $this->returnBadRequest();
        }

        $cliente = $this->clienteService->get($id);

        if (is_null($cliente)) {
            return $this->returnBadRequest();
        }

        $this->clienteService->destroy($intId);

        return response()->json(null, 200);
    }
}
