<?php 

declare(strict_types=1);

namespace Source\User\Domain\Interfaces;

use Source\User\App\Events\UserCreatedReadEvent;
use Source\User\Domain\Entity\User;
use Source\User\Domain\Events\UserUpdatedReadEvent;
use Source\User\Domain\ValueObjects\Email;
use Source\User\Domain\ValueObjects\UserID;

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
    /**
     * Method to check if email exists
     * @param Email $email
     * @return bool
     */
    public function emailExists(Email $email): bool;

  
}