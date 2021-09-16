<?php

namespace App\Controllers;

use Core\Auth;
use Core\View;

class HomeController
{
    public function home()
    {
        if (Auth::validarAcesso('boolean')) {
            View::render('home', [], 'layoutDashboard');
        } else {
            View::render('home');
        }
    }
}
