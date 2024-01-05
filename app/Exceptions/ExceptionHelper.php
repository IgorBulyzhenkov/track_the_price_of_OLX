<?php

namespace App\Exceptions;

use App\Helpers\EnvHelper;
use App\Http\Controllers\BaseController;
use Exception;

class ExceptionHelper extends Exception
{
    public static function returnResponseData( \Throwable $e){
        return array_filter([
            'status' => BaseController::STATUS_ERR,
            'error' => [
                'description' => $e->getMessage()
            ],
            "debug" => EnvHelper::isLocal() ? [
                "place" => $e->getFile() . ':' . $e->getLine(),
                "trace" => $e->getTraceAsString()
            ] : []
        ]);
    }
}
