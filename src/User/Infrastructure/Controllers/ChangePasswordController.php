<?php

declare(strict_types=1);

namespace Source\User\Infrastructure\Controllers;

use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Source\User\App\Services\User\ChangePassword\ChangePasswordService;
use Source\User\Infrastructure\Repository\Exception\UserNotFoundException;

class ChangePasswordController
{
    /**
     * @var ChangePasswordService $changePasswordService
     */
    private ChangePasswordService $changePasswordService;
/**
 * ChangePasswordController construct
 * @param ChangePasswordService $changePasswordService
 */
    public function __construct(ChangePasswordService $changePasswordService)
    {

        $this->changePasswordService = $changePasswordService;
    }

    /**
     * Invoke method to change password
     * @param Request $request
     * @param string $uuid
     * @return JsonResponse
     * @throws HttpResponseException
     * @throws UserNotFoundException
     */
    public function __invoke(Request $request, string $uuid):JsonResponse
    {
      
        try {
            $this->changePasswordService->execute( $request->input('password_old')?? null, $request->input('new_password')?? null,$uuid,$request->ip?? null );

            return response()->json(['message' => 'Password changed successfully'], 200);
        } catch (UserNotFoundException | \InvalidArgumentException $e) {
            throw new HttpResponseException (response()->json(['message' => $e->getMessage()], $e->getCode()));
        } 

    }
}
