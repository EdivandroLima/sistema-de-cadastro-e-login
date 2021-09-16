<?php

namespace App\Controllers\Auth;

use Core\View;
use App\Models\Usuario;
use \Respect\Validation\Validator;

class RegisterController
{
    public function index()
    {
        View::render('auth.registro');
    }

    /**
     * Validar dados e fazer um novo registro de usuário
     *
     * @return void
     */
    public function register()
    {
        $this->validarNome($_POST['nome']);
        $this->validarEmail($_POST['email']);
        $this->validarSeEmailJaFoiCadastrado($_POST['email']);
        $this->validarSenha($_POST['senha']);
        (new Usuario)->novoRegistro($_POST['nome'], $_POST['email'], $_POST['senha']);
        header('Location: /registro?info=success');
    }

    public function validarEmail(String $email)
    {
        if (Validator::email()->validate($email)) {
            return true;
        } else {
            header('Location: /registro?erro=email');
            exit();
        }
    }

    public function validarNome(String $nome)
    {
        if (Validator::stringType()->length(3, null)->validate($nome)) {
            return true;
        } else {
            header('Location: /registro?erro_user_min');
            exit();
        }
    }

    public function validarSenha(String $senha)
    {
        if (!preg_match('/[A-Za-z]/', $senha) || !preg_match('/[0-9]/', $senha)) {
            header('Location: /registro?erro=senha_invalida'); // 'Senha tem que ter caracteres e números';
            exit();
        }
        if (!preg_match('/^[\w$@]{6,}$/', $senha)) {
            header('Location: /registro?erro=senha_min'); // 'Senha tem que tem 6 ou mais caracteres';
            exit();
        }
        if ($_POST['r-senha'] != $senha) {
            header('Location: /registro?erro=form_senha');
            exit();
        }
        return true;
    }

    public function validarSeEmailJaFoiCadastrado(String $email): void
    {
        if ((new Usuario)->verificarSeEmailExist($_POST['email'])) {
            header('Location: /registro?erro=email');
            exit();
        }
    }
}
