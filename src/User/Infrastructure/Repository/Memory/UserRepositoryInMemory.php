<?php 

declare(strict_types=1);
namespace Source\User\Infrastructure\Repository\Memory;

use Source\User\Domain\Entity\User;
use Source\User\Domain\Interfaces\UserRepositoryInterface;

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
