<?php 

declare(strict_types=1);



namespace Source\User\Infrastructure\Repository\Memory;

use Source\User\Domain\Entity\User;
use Source\User\Domain\Interfaces\UserRepositoryInterface;
use Source\User\Domain\ValueObjects\Email;
use Source\User\Domain\ValueObjects\Ui;
use Source\User\Domain\ValueObjects\UserID;
use Source\User\Infrastructure\Repository\Exception\UserNotFoundException;

class UserRepositoryInMemory implements UserRepositoryInterface
{
    private array $users;

    public function __construct(array $users= []){

        $this->users = $users;
    }

    public function insertUser(User $user)
    {

        $this->users[$user->getId()->toString()] = $user;
    }

    public function findbyId(UserID $id)
    {

        if (!isset($this->users[$id->toString()])) {
            throw new UserNotFoundException();
        }
        return $this->users[$id->toString()];
    }

    public function findByEmail(Email $email)
    {

        foreach ($this->users as $user) {
            if ($user->getEmail()->ToString() === $email->ToString()) {
                return $user;
            }
        }
    }

    public function save(User $user)
    {

        $this->users[$user->getId()->toString()] = $user;
    }

    public function deleteUser(User $user)
    {

        unset($this->users[$user->getId()->toString()]);
    }
    } 
