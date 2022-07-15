<?php

namespace App\Http\Controllers;

use App\Services\AuthService;
use Laravel\Lumen\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Auth\Access\AuthorizationException;

class AuthController extends BaseController
{

    private $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function login(Request $request)
    {
        //Validacao
        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'senha' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), Response::HTTP_BAD_REQUEST);
        }

        try {
            $resultado = $this->authService->login($request->email, $request->senha);
        } catch (AuthorizationException $ae) {
            return response()->json([
                "message" => $ae->getMessage()
            ], Response::HTTP_UNAUTHORIZED);
        }

        return response()->json($resultado);
    }

    public function updatePsw(Request $request)
    {
        return $this->authService->updatePsw($request);
    }
}
