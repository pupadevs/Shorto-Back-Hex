<?php

declare(strict_types=1);

namespace Tests\Fixtures;

use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Testing\Fakes\Fake;
use Source\User\Domain\Entity\User;
use Source\User\Domain\ValueObjects\Email;
use Source\User\Domain\ValueObjects\Name;
use Source\User\Domain\ValueObjects\Password;

class Users
{
    public static function aUser(): User
    {   
        return User::createUser(
            new Name('John Doe'),
            new Email(fake()->unique()->email()),
            new Password('a-password')
        );
    }
}
