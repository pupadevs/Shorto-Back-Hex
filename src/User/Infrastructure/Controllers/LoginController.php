<?php 

declare(strict_types=1);

namespace Source\User\Infrastructure\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Source\User\Infrastructure\Repository\UserEloquentModel;

class LoginController
{

    public function __invoke(Request $request){

        if (Auth::attempt($request->only('email', 'password'))) {
            $user = Auth::user();
           $k= new UserEloquentModel();
           $k->createToken('auth_token')->accessToken;
             /** @var \Source\User\Infrastructure\\Repository\UserEloquentModel $user **/   
           $token = $user->createToken('auth_token')->accessToken;

            return response()->json(['message' => 'Logged in', 'user' => $user->name, 'auth_token' => $token], 200);
        }
        return response()->json(['message' => 'User or password incorrect'], 401);
    }
}