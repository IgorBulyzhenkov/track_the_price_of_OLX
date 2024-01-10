<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;

class BaseController extends Controller
{
    const STATUS_OK         = '1';
    const STATUS_ERR        = '0';

    const USD               = 'USD';
    const UAH               = 'UAH';
    const EUR               = 'EUR';

    protected string $date;

    public function __construct()
    {
        $this->date = Carbon::now()->format('Y');
    }
}
