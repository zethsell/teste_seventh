<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{

    protected function redirectTo($request)
    {
        # Linha inserida pra definir q todas as requisicoes sao do tipo 'application/json'
        $request->headers->set('Accept', 'application/json');

        /*  if (! $request->expectsJson()) {
              return route('login');
          }*/
    }
}
