<?php 

declare(strict_types=1);

namespace Source\User\Infrastructure\Repository\Eloquent\Read;

use Illuminate\Database\Eloquent\Model;

final class UserLogReadEloquentModel extends Model
{
    protected $connection = 'mysql_read';
    protected $table = 'users_logs';    

    protected $primaryKey = 'id';

    protected $keyType = 'string';

    public $incrementing = false;

    protected $fillable = [
        'user_id',
        'action',
        'event_type',
        'id',
        'created_at',

    ]    ;


    }