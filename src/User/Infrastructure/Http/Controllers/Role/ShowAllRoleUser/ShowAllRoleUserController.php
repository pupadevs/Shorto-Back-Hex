<?php

declare(strict_types=1);

namespace Source\User\Infrastructure\Http\Controllers\Role\ShowAllRoleUser;

use Illuminate\Http\Request;
use Source\User\App\Services\Role\ShowAllRoleUser\ShowAllRoleUserService;


class ShowAllRoleUserController
{

    public function __construct(private ShowAllRoleUserService $showAllRoleUserService){}
    public function __invoke(Request $request)
    {
       $result = $this->showAllRoleUserService->execute();
       return response()->json($result, 200);
    }

}