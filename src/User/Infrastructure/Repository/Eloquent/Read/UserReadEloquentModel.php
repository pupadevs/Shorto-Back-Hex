<?php

declare(strict_types=1);

namespace Source\User\Infrastructure\Repository\Eloquent\Read;

use Illuminate\Database\Eloquent\Model;

final class UserReadEloquentModel extends Model
{
    protected $connection = 'mysql_read';
    protected $table = 'users';

    protected $primaryKey = 'id';

    protected $keyType = 'string';

    public $incrementing = false;

    protected $fillable = [
        'id',
        'name',
        'email',
        'password',
    ];
}
