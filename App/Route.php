<?php

namespace App;

require_once "../App/Controllers/Controller.php";

use App\Controllers\Controllers;

class Route extends Controllers
{
    public $routes;
    public $route;

    public function __construct()
    {
        // seta a rota de acordo com a url
        $this->route = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

        $this->initRoutes();
    }

    // Lista de todas as rotas em um array
    public function initRoutes()
    {
        $routes[] = array(
            'route' => '/',
            'controller' => 'index'
        );

        $routes[] = array(
            'route' => '/sobre',
            'controller' => 'sobre'
        );

        $routes[] = array(
            'route' => '/login',
            'controller' => 'login'
        );

        $routes[] = array(
            'route' => '/registro',
            'controller' => 'registro'
        );

        $routes[] = array(
            'route' => '/registro/salvar',
            'controller' => 'registroSalvar'
        );

        $routes[] = array(
            'route' => '/login/auth',
            'controller' => 'autenticar'
        );

        $routes[] = array(
            'route' => '/dashboard',
            'controller' => 'dashboard'
        );

        $routes[] = array(
            'route' => '/logout',
            'controller' => 'logout'
        );

        $routes[] = array(
            'route' => '/usuarios',
            'controller' => 'usuarios'
        );

        $this->routes = $routes;
    }

    // Ação de acordo com a rota
    public function action()
    {
        foreach ($this->routes as $key => $routes) {

            if ($routes['route'] == $this->route) {

                // vai chamar o metodo do Controller e executa de acordo com a rota
                $metodo = $routes['controller'];
                $this->$metodo();
            }
        }
    }
}
