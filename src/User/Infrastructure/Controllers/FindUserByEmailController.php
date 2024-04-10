<?php

declare(strict_types=1);

namespace Source\User\Infrastructure\Controllers;

use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
use Source\User\App\Services\FindUserByEmailService;
use Source\User\Infrastructure\Repository\Exception\UserNotFoundException;

class FindUserByEmailController
{
    private FindUserByEmailService $findUserService;

    public function __construct(FindUserByEmailService $findUserService)
    {

        $this->findUserService = $findUserService;
    }

    public function __invoke(Request $request)
    {
        try {
            $user = $this->findUserService->execute($request->email);

            return response()->json(['user' => $user], 200);
        } catch (UserNotFoundException $userNotFoundException) {
            throw new HttpResponseException(response()->json(['error' => $userNotFoundException->getMessage()], $userNotFoundException->getCode()));
        }
    }
}
