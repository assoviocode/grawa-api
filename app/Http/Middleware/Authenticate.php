<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Factory as Auth;
use App\Models\Usuario as Usuario;
use Firebase\JWT\JWT;

class Authenticate
{
    /**
     * The authentication guard factory instance.
     *
     * @var \Illuminate\Contracts\Auth\Factory
     */
    protected $auth;

    /**
     * Create a new middleware instance.
     *
     * @param  \Illuminate\Contracts\Auth\Factory  $auth
     * @return void
     */
    public function __construct(Auth $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        try {

            if (!$request->hasHeader('Authorization')) {
                throw new \Exception();
            }

            $autorizationHeader = $request->header('Authorization');
            $token = str_replace('Bearer ', '', $autorizationHeader);
            $dadosAutenticacao = JWT::decode($token, env('APP_KEY'), array(
                'HS256'
            ));

            $user = Usuario::where('email', $dadosAutenticacao->email)->first();

            if (is_null($user)) {
                throw new \Exception();
            }

            return $next($request);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Não autorizado'
            ], 401);
        }
    }
}
