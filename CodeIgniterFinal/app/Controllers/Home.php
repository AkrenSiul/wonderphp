<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {
        return view('frontend/header').
            view('welcome_message')
            .view('frontend/footer');
    }
}
