<?php 

declare(strict_types=1);
namespace Source\User\Infrastructure\Repository\User\Memory;

use Source\User\Domain\Entity\User\User;
use Source\User\Domain\Events\User\ChangePasswordEvent\ChangePasswordReadEvent;
use Source\User\Domain\Interfaces\UserRepositoryContracts\UserRepositoryInterface;
use Source\User\Domain\ValueObjects\User\Password;

class UserRepositoryInMemory implements UserRepositoryInterface
{
    /**
     * @var array
     */
    private array $users;
/**
 * UserRepositoryInMemory constructor.
 * @param array $users
 * 
 */
    public function __construct(array $users= []){

        $this->users = $users;
    }
/**
 * Method to insert user
 * @param User $user
 * @return bool
 */
    public function insertUser(User $user):bool
    {

        $this->users[$user->getId()->toString()] = $user;
        return true;
    }
/**
 * Method to save user
 * @param User $user
 * @return void
 */

    public function save(User $user):void
    {
        $this->users[$user->getId()->toString()] = $user;
    }

    public function changePassword(ChangePasswordReadEvent $event): void
    {
     $user=   $this->users[$event->getUser()->getId()->toString()] = $event->getUser();
     $user->changePassword(new Password($event->getUser()->getPassword()->toString()));

    
    }
/**
 * Method to delete user
 * @param User $user
 * @return bool
 */
    public function deleteUser(User $user):bool
    {

        unset($this->users[$user->getId()->toString()]);
        return true;
    }
    } 
