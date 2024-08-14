<?php

declare(strict_types=1);

namespace Source\User\Domain\ValueObjects\User;

use Source\Shared\StringValueObject\StringValueObject;

class Password implements StringValueObject
{
    /**
     * Password
     * @var string
     */
    private string $password;
/**
 * Password constructor.
 * @param string $password
 */
    public function __construct(?string $password = null)
    {
       /*  if($password < 8){
            throw new \InvalidArgumentException('Password must be at least 8 characters long', 400);
        } */
       
     
       $this->verifyPassword($password);
       
        $this->password = $this->ensurePasswordHashed($password);
    }

    public function ToString(): string
    {

        return (string) $this;
    }

    public function __toString(): string
    {
        return $this->password;
    }

    /**
     * Verify password and throw exception if invalid or null
     * @param string|null $password
     * @throws \Exception
     */
    private function verifyPassword(?string $password)
    {
        if ($password === null || strlen($password) < 8) {
            throw new \InvalidArgumentException('Password must be at least 8 characters long', 400);
        }
    }
    private function ensurePasswordHashed($password) {
        // Verificamos si la contraseña ya está hasheada
        if ($this->isHashed($password)) {
            return $password;
        }
        // Si no está hasheada, la hasheamos
        return password_hash($password, PASSWORD_DEFAULT);
    }

    private function isHashed($password) {
        // Verificamos la longitud y el formato del hash
        // Los hashes generados por password_hash en PHP son siempre de 60 caracteres de largo
        return (strlen($password) === 60 && preg_match('/^\$2[ayb]\$[0-9]{2}\$.{53}$/', $password));
    }


 
}