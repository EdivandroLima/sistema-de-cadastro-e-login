<?php

// Todas as rotas

/**
 * setRoute
 *
 * @param  string rota -> /minha_rota
 * @param  string controlador e método -> MeuController@home
 */
$route->setRoute('/', 'HomeController@home');
$route->setRoute('/registro', 'Auth/RegisterController@index');
$route->setRoute('/registro/salvar', 'Auth/RegisterController@register');

$route->setRoute('/login', 'Auth/LoginController@index');
$route->setRoute('/login/auth', 'Auth/LoginController@login');
$route->setRoute('/logout', 'Auth/LoginController@logout');

$route->setRoute('/dashboard', 'DashboardController@index');
$route->setRoute('/usuarios', 'DashboardController@usuarios');
