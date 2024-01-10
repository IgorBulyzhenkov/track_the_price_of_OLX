<?php

namespace App\Http\Controllers;

class WaitController extends BaseController
{
    public function index()
    {
        return view('confirm.wait',[
            'date' => $this->date
        ]);
    }
}
