<?php 

declare(strict_types=1);

namespace Source\User\Infrastructure\Controllers;

use Illuminate\Support\Facades\DB;

class ShowAllLogsController
{
    public function __invoke()
    {
        $logs= DB::connection('mysql_read')->table('users_logs')->get();
        return $logs;
    }   
}