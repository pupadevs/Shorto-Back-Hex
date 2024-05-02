<?php 

declare(strict_types=1);

namespace Source\User\Domain\Interfaces;

use Source\User\App\Events\UserCreatedReadEvent;
use Source\User\Domain\Entity\User;
use Source\User\Domain\Events\UserCreatedLogEvent;
use Source\User\Domain\Events\UserUpdatedLogEvent;
use Source\User\Domain\Events\UserUpdatedReadEvent;
use Source\User\Domain\ValueObjects\Email;
use Source\User\Domain\ValueObjects\UserID;

interface UserReadRepositoryInterface
{

    public function insertUserReadDB(UserCreatedReadEvent $event);

    public function getUserByID(UserID $userID): User;
    public function getUserByEmail(Email $email): User;



    public function save(UserUpdatedReadEvent $user);

    public function emailExists(Email $email): bool;

  
}