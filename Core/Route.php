<?php

namespace Core;

class Route
{
    public $routes = []; // Todas as rotas em um array
    public $route; // Rota atual

    public function __construct()
    {
        // add a rota de acordo com a url
        $this->route = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    }

    // Ação de acordo com a rota
    public function action()
    {
        foreach ($this->routes as $key => $route) {
            if ($route['route'] == $this->route) {
                $controller = $route['controller'];
                $metodo = $route['method'];

                // instânciar a classe e executar o método
                $class = "\\App\\Controllers\\" . $this->verificarSubPastaController($controller);
                $class = new $class;
                $class->$metodo();
            }
        }

        // se a rota não existe, retorna 404
        if(!isset($class)) {
            http_response_code(404);
            echo "<h1>Erro 404 - Página não encontrada.</h1>";
        }
    }

    public function verificarSubPastaController(String $controller)
    {
        $subPasta = explode('/', $controller);
        if (count($subPasta) > 1) {
            return $subPasta[0] . "\\" . $subPasta[1];
        }
        return $subPasta[0];
    }

    /**
     * setRoute
     *
     * @param  mixed $currentRoute
     * @param  mixed $controller_method
     * @return void
     */
    public function setRoute(String $currentRoute, String $controller_method): void
    {
        $route = [
            'route' => $currentRoute,
            'controller' => explode('@', $controller_method)[0],
            'method' => explode('@', $controller_method)[1],
        ];
        array_push($this->routes, $route);
    }
}
