<?php 

declare(strict_types=1);

namespace Source\User\Infrastructure\Repository\Exception;

use Exception;

class EmailExistsException extends Exception
{

    public function __construct()
    {
        parent::__construct('Email already exists', 400);
    }
}