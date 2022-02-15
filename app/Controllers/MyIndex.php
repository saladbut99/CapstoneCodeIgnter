<?php

namespace App\Controllers;

class MyIndex extends BaseController
{
    public function showIndex()
    {
        return view('index');
    }
}
