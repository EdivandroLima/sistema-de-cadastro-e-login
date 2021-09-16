<?php

namespace App\Controllers\Auth;

use App\Models\Usuario;
use Core\View;

class LoginController
{
    public function index()
    {
        View::render('auth.login');
    }
    
    /**
     * login - Autenticar dados de acesso e redireciona
     *
     * @return void
     */
    public function login()
    {
        if ((new Usuario)->autenticarUsuario($_POST['email'], $_POST['senha'])) {
            if (isset($_POST['lembrar_me'])) {
                $this->lembrarMe($_POST['email']);
            }
            header('Location: /dashboard');
        } else {
            header('Location: /login?login=erro');
        }
    }

    public function lembrarMe($user)
    {
        $validade = strtotime('+1 month');
        setcookie('sisgen_user', $user, $validade, "/", "", false, true);
    }

    public function logout()
    {
        session_start();
        session_destroy();
        $validade = time() - 3600;
        setcookie('sisgen_user', '', $validade, "/", "", false, true);
        header('Location: /');
    }
}
