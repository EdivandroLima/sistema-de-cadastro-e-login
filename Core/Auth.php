<?php

namespace Core;

class Auth
{    
    /**
     * validarAcesso
     *
     * @param  mixed $bool -> definir se retorna é boolean para user autenticado
     * @return void
     */
    public static function validarAcesso($returnBoolean = false)
    {
        session_start();
        if (!isset($_SESSION['autenticado']) || !$_SESSION['autenticado']) {
            if($returnBoolean) {
                return false;
            }
            header('Location: /?auth=not');
        }
        return true;
    }
}
