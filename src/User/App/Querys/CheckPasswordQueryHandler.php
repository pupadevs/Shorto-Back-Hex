<?php 

declare(strict_types=1);

namespace Source\User\App\Querys;

use Illuminate\Http\Exceptions\HttpResponseException;

class CheckPasswordQueryHandler 
{
    /**
     * Method to check password
     * @param CheckPasswordQuery $query
     * @throws HttpResponseException
     * @return bool 
     */
    public function handle(CheckPasswordQuery $query): bool
    {
        $password = password_verify($query->getPasswordRequest(), $query->getPasswordDb());
    
        if ($password) {
        return $password;

        }
            throw new HttpResponseException(response()->json(['message' => 'Invalid password'], 401));

        

    }
}