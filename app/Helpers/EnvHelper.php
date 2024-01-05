<?php

namespace App\Helpers;

use App\Models\User;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Arr;

class EnvHelper
{
    /**
     * Возвращает true с локальной машины
     */
    public static function isLocal(): bool
    {
        return env('APP_ENV', 'null') === 'local' ;
    }

    /**
     * Возвращает true с продакшн-машины
     */
    public static function isProd(): bool
    {
        return !self::isLocal() ;
    }

}
