<?php

namespace Source\User\App\Services\Contracts;

interface ChangePasswordInterface
{
    public function execute(?string $password = null, ?string $email = null);
}
