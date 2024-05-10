<?php 

namespace Source\User\Infrastructure\Repository;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;


class UserEloquentModel extends Authenticatable{

    use HasApiTokens, HasFactory, Notifiable;

    protected $conection = 'mysql';
    protected $database = 'mysql';
    protected $table = 'users';
}