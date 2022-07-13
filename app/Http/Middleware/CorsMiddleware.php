<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CorsMiddleware
{

    public function handle(Request $request, Closure $next)
    {
        //Intercepts OPTIONS requests
        if ($request->isMethod('OPTIONS')) {
            $response = response('', 200);
        } else {
            // Pass the request to the next middleware
            $response = $next($request);
        }



        $IlluminateResponse = 'Illuminate\Http\Response';
        $SymfonyResponse = 'Symfony\Component\HttpFoundation\Response';

        if ($response instanceof $IlluminateResponse) {
            // Adds headers to the response
            $response->header('Access-Control-Allow-Methods', 'HEAD, GET, POST, PUT, PATCH, DELETE');
            $response->header('Access-Control-Allow-Headers', $request->header('Access-Control-Request-Headers'));
            $response->header('Access-Control-Allow-Origin', '*');
        }


        if ($response instanceof $SymfonyResponse) {
            $response->headers->set('Access-Control-Allow-Methods', 'HEAD, GET, POST, PUT, PATCH, DELETE');
            $response->headers->set('Access-Control-Allow-Headers', $request->header('Access-Control-Request-Headers'));
            $response->headers->set('Access-Control-Allow-Origin', '*');
        }

        // Sends it
        return $response;
    }
}
