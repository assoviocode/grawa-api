<?php
namespace app\Services;

use App\Models\Usuario;
use Firebase\JWT\JWT;

class TokenService
{

    public static function encodeJWT($value)
    {
        return JWT::encode($value, env('APP_KEY'), 'HS256');
    }

    public static function decode($token)
    {
        return JWT::decode($token, env('APP_KEY'), array(
            'HS256'
        ));
    }

    public static function createToken(Usuario $user)
    {
        return self::encodeJWT(array(
            'cpf' => $user->cpf,
            'email' => $user->email,
            'perfil' => $user->perfil,
            'datetime' => date("Y-m-d H:i:s")
        ));
    }

    public static function getUserByToken(string $token)
    {
        $dadosAutenticacao = self::decode($token);
        return Usuario::where('cpf', $dadosAutenticacao->cpf)->first();
    }
}

