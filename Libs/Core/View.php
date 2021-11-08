<?php

class View
{
    function getView($controller, $view, $data = "")
    {
        $controller = get_class($controller);
        if ($controller == 'Index') {
            $view = 'View/' . $view . ".php";
        } else {
            $view = 'View/' . $controller . '/' . $view . ".php";
        }
        require_once($view);
    }
}
