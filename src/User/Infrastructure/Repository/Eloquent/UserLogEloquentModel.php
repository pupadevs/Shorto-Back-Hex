<?php

declare(strict_types=1);

namespace Source\User\Infrastructure\Repository\Eloquent;

use Illuminate\Database\Eloquent\Model;

final class UserLogEloquentModel extends Model
{
    protected $table = 'users_logs';

    

    protected $primaryKey = 'id';

    protected $keyType = 'string';

    public $incrementing = false;

    protected $connection = 'mysql';

    protected $fillable = [
        'id',
        'user_id',
        'action',
        'event_type',
    ];
}
