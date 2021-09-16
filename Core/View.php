<?php

namespace Core;

class View
{
    /**
     * Exibir uma view do diretório 'Views'
     *
     * @param  mixed $view -> nome do arquivo, ex: index (index.phtml)
     * @param  mixed $data -> Dados para ser exibidos na view
     * @param  mixed $layout -> Layout do diretórioa 'Views/layout'
     * @return void
     */
    public static function render(String $view, Array $data = [], String $layout = 'layout'): void
    {
        $view = str_replace('.','/', $view);
        extract($data);
        require __DIR__ . "/../App/Views/layout/$layout.phtml";
    }

    /**
     * O título é definido pelo nome da view, ex: home.phtml (Home), auth/login.phtml (Login), registro.phtml
     *
     * @param  mixed $view
     * @return void
     */
    public static function title(String $view)
    {
        return ucfirst(str_replace('/', '', substr($view, strpos($view, '/'), 100)));
    }
}
