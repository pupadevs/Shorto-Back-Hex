<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Source\User\App\Services\Role\AssingRoleToUserService;
use Source\User\App\Services\Role\AssingRoleToUserServiceInterface;
use Source\User\Domain\Interfaces\RoleRepository\RoleReadRepositoryInterface;
use Source\User\Domain\Interfaces\RoleRepository\RoleRepositoryInterface;
use Source\User\Infrastructure\Repository\Role\Read\RoleReadRepository;
use Source\User\Infrastructure\Repository\Role\RoleRepository;

class RoleServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(RoleRepositoryInterface::class, RoleRepository::class);
        $this->app->bind(RoleReadRepositoryInterface::class, RoleReadRepository::class);
        $this->app->bind(AssingRoleToUserServiceInterface::class, AssingRoleToUserService::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
