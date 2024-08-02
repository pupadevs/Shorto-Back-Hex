<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Source\Role\App\Service\AssingRoleToUserService;
use Source\Role\App\Service\AssingRoleToUserServiceInterface;
use Source\Role\Domain\RoleReadRepositoryInterface;
use Source\Role\Domain\RoleRepositoryInterface;
use Source\Role\Infrastructure\Repository\Read\RoleReadRepository;
use Source\Role\Infrastructure\Repository\RoleRepository;

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
