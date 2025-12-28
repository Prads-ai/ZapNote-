<?php

namespace app\controllers;

use JetBrains\PhpStorm\NoReturn;

class HomeController
{
    #[NoReturn]
    public function index(): void
    {
        view('home');
    }
}