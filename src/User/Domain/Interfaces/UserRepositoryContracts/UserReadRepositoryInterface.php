<?php 

declare(strict_types=1);

namespace Source\User\Domain\Interfaces\UserRepositoryContracts;

use Source\User\Domain\Entity\User\User;
use Source\User\Domain\Events\User\ChangePasswordEvent\ChangePasswordReadEvent;
use Source\User\Domain\Events\User\DeleteUserEvent\DeleteUserReadEvent;
use Source\User\Domain\Events\User\UserCreatedEvent\UserCreatedReadEvent;
use Source\User\Domain\Events\User\UserUpdatedEvent\UserUpdatedReadEvent;
use Source\User\Domain\ValueObjects\User\Email;
use Source\User\Domain\ValueObjects\User\UserID;

interface UserReadRepositoryInterface
{

    /**
     * Method to insert user
     * @param UserCreatedReadEvent $event
     * 
     */
    public function insertUserReadDB(UserCreatedReadEvent $event);
/**
 * Method to get user by ID
 * @param UserID $userID
 * @return User
 */
    public function getUserByID(UserID $userID): User;
    /**
     * Method to get user by email
     * @param Email $email
     * @return User
     */
    public function getUserByEmail(Email $email): User;

    /**
     * Method to save user
     * @param UserUpdatedReadEvent $user
     * @return void
     */

    public function save(UserUpdatedReadEvent $user): void;

    
    public function changePassword(ChangePasswordReadEvent $event): void;
    /**
     * Method to check if email exists
     * @param Email $email
     * @return bool
     */
    public function emailExists(Email $email): bool;

    public function deleteUser(DeleteUserReadEvent $user);

  
}