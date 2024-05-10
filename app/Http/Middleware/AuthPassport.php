<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class AuthPassport
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        $token = $request->bearerToken();

        if (!$token) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        var_dump($token);

        // Verificar si el token existe en la base de datos de lectura
        $tokenExists = DB::connection('mysql_read')->table('oauth_access_tokens')->where('id', $token)->exists();
        $k = DB::connection('mysql_read')->table('oauth_access_tokens')->get();
        var_dump($k);

        if (!$tokenExists) {
            return response()->json(['error' => 'Invalid token'], 401);
        }

        return $next($request);
    }
}
