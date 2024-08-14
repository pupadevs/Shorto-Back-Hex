<?php

declare(strict_types=1);

namespace Source\User\Domain\Interfaces\UserRepositoryContracts;

//use Source\User\Domain\Entity\User;
use Source\User\Domain\Entity\User\User;


interface UserRepositoryInterface
{
    /**
     * Method to insert user
     * @param User $user
     * @return bool
     */
    public function insertUser(User $user):bool;

/**
 * Method to save user
 * @param User $user
 * @return void
 */
    public function save(User $user);


/**
 * Method to delete user
 * @param User $user
 * @return bool
 */
    public function deleteUser(User $user):bool;

}
