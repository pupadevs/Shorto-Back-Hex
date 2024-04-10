<?php

declare(strict_types=1);

namespace Source\User\Infrastructure\Controllers;

use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Source\User\App\Services\ChangePasswordService;
use Source\User\Infrastructure\Repository\Exception\UserNotFoundException;

class ChangePasswordController
{
    private ChangePasswordService $changePasswordService;

    public function __construct(ChangePasswordService $changePasswordService)
    {

        $this->changePasswordService = $changePasswordService;
    }

    public function __invoke(Request $request):JsonResponse
    {

        try {
            $data = $request->all();

            $this->changePasswordService->execute($data['email'], $data['password_old'], $data['new_password']);

            return response()->json(['message' => 'Password changed successfully'], 200);
        } catch (UserNotFoundException $e) {
            throw new HttpResponseException (response()->json(['message' => $e->getMessage()], 404));
        }catch (\Exception $e) {

            throw new HttpResponseException (response()->json(['message' => $e->getMessage()], 500));
        }

    }
}
