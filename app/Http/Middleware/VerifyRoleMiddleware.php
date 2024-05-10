<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class VerifyRoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
      $result= DB::connection('mysql')->table('users')->where('id', $request->user()->id)->update(['role' => 'admin']);

        if ($result == 0) {
            return redirect()->route('home');
        }
        return $next($request);
    }
}
