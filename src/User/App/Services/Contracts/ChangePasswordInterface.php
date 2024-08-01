<?php

namespace Source\User\App\Services\Contracts;

interface ChangePasswordInterface
{
    public function execute(?string $password_old , ?string $new_password , ?string $uuid , ?string $ip ):void;
}
