<?php

namespace App\Action;

class Action
{
    public function render($action, $layout)
    {
        require "../App/Views/$layout.phtml";
    }
}
