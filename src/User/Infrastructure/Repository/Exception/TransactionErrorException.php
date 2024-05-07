<?php 

declare(strict_types=1);

namespace Source\User\Infrastructure\Repository\Exception;

use Exception;

class TransactionErrorException extends Exception
{




    public function __construct()
    {
        parent::__construct('Transaction error', 500);
    }
}