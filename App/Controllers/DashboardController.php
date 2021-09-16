<?php

namespace App\Controllers;

use Core\Auth;
use Core\View;
use App\Models\Usuario;

class DashboardController
{
    public function __construct()
    {
        Auth::validarAcesso();
    }

    public function index()
    {
        View::render('dashboard.dashboard', [], 'layoutDashboard');
    }
    
    /**
     * Listar todos os usuários
     *
     * @return void
     */
    public function usuarios()
    {
        $usuarios= Usuario::usuarios();
        View::render('dashboard.usuarios', ['usuarios' => $usuarios], 'layoutDashboard');
    }
}

