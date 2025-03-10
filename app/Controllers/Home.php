<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {
        return view('welcome_message', $data = ['title' => 'Home']);
    }

    public function user()
    {
        return view('master/v_user', $data = ['title' => 'User']);
    }
}
