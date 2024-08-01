<?php 

declare(strict_types=1);

namespace Source\User\App\Querys;

class CheckPasswordQueryHandler 
{
    /**
     * Method to check password
     * @param CheckPasswordQuery $query
     * @throws \InvalidArgumentException
     * @return bool 
     */
    public function handle(CheckPasswordQuery $query): bool
    {
      
        $password = password_verify($query->getPasswordRequest(), $query->getPasswordDb()->ToString());
      
       
        if (!$password) {
        throw new \InvalidArgumentException('Invalid password', 400);

        }
        return $password;


        

    }
}