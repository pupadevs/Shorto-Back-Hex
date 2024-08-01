<?php

declare(strict_types=1);

namespace Source\User\Domain\Interfaces;

//use Source\User\Domain\Entity\User;
use Source\User\Domain\Entity\User;
use Source\User\Domain\Events\ChangePasswordReadEvent;
use Source\User\Domain\ValueObjects\Email;
use Source\User\Domain\ValueObjects\UserID;

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
