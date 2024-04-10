<?php 

declare(strict_types=1);

namespace Source\User\Infrastructure\Repository\Eloquent;

use Illuminate\Database\Eloquent\Model;

final class UserEloquentModel extends Model
{
    protected $connection = 'mysql';
    protected $table = 'users';

    protected $primaryKey = 'id';

    protected $keyType = 'string';

    public $incrementing = false;

    protected $fillable = [
        'id',
        'name',
        'email',
        'password',
    ]   ;

}