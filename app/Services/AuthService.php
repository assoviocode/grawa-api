<?php

namespace App\Services;


use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Daos\IUsuarioDAO;
use App\Models\Usuario;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;

class AuthService
{

    private $usuarioDAO;

    public function __construct(IUsuarioDAO $usuarioDAO)
    {
        $this->usuarioDAO = $usuarioDAO;
    }

    public function login(string $email, string $senha)
    {
        //Autenticacao
        $usuario = $this->usuarioDAO->getByEmail($email);
        // dd($usuario);

        if (is_null($usuario) || !Hash::check($senha, $usuario->senha)) {
            throw new AuthorizationException("Usuário ou senha inválidos");
        }

        $token = TokenService::createToken($usuario);

        $usuario->token = $token;

        return array("usuario" => $usuario);
    }

    public function updatePsw()
    {

        $usuarios = $this->usuarioDAO->getAll();

        foreach ($usuarios as $usuario) {
            if (strlen($usuario->senha) == 6) {
                $usuario->encryptPassword();
                $this->usuarioDAO->save($usuario);
            }
        }

        return [];
    }

    public function getLoggedInUser()
    {
        try {
            return $this->usuarioDAO->get(Auth::user()->id);
        } catch (\Exception $e) {
            throw new AuthenticationException("Usuário não autenticado!");
        }
    }
}
