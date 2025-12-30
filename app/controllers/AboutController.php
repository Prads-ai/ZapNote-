<?php

namespace app\controllers;

use JetBrains\PhpStorm\NoReturn;

/**
 * Controller for the About page.
 * 
 * Displays information about ZapNote application.
 * 
 * @package app\controllers
 */
class AboutController extends Controller
{
    /**
     * Displays the About page.
     * 
     * Shows information about ZapNote, its features, and purpose.
     * 
     * @return void Never returns (calls view() which exits)
     */
    #[NoReturn]
    public function index(): void
    {
        view('about');
    }
}

