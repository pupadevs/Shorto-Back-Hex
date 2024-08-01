<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\Routing\Exception\RouteNotFoundException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }
    public function render($request, Throwable $exception)
    {
        if ($exception instanceof MethodNotAllowedHttpException) {
            return response()->json(['error' => 'El metodo que estas utilizando no es valido.'], 405);

        } 
           /*  if ($exception instanceof RouteNotFoundException) {
                return response()->json(['error' => 'El metodo que estas utilizando no es valido.'], 405);

            } */
        

        return parent::render($request, $exception);
    }

 /*    protected function unauthenticated($request, AuthenticationException $exception)
    {
        if ($exception instanceof AuthenticationException) {
            return response()->json(['error' => 'No tiene autorizacion para acceder a esta ruta'], 401);
        }

        return parent::render($request, $exception);
      
    }  */

}
