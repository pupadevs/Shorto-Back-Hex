<?php

declare(strict_types=1);

namespace Source\User\Domain\Interfaces;

//use Source\User\Domain\Entity\User;
use Source\User\Domain\Entity\User;
use Source\User\Domain\ValueObjects\Email;
use Source\User\Domain\ValueObjects\UserID;

interface UserRepositoryInterface
{
    public function insertUser(User $user);

   public function findbyId(UserID $id);

    public function findByEmail(Email $email);

    public function save(User $user);

    public function deleteUser(User $user);

}
