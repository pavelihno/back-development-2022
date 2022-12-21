<?php

class Route
{

    static function start()
    {
        $controller_name = 'Main';
        $action_name = 'index';

        $routes = explode('/', $_SERVER['REQUEST_URI']);

        // имя контроллера
        if (!empty($routes[2])) {
            $controller_name = $routes[2];
        }

        // имя действия
        if (!empty($routes[3])) {
            $action_name = $routes[3];
        }

        $controller_name = $controller_name.'Controller';

        $controller_file = strtolower($controller_name).'.php';
        $controller_path = "app/controllers/".$controller_file;

        if(file_exists($controller_path)) {
            include "app/controllers/".$controller_file;

            // вызов контроллера
            $controller = new $controller_name;
            $action = $action_name;
            if(method_exists($controller, $action)) {
                $controller->$action();
            }
            else {
                Route::throwException();
            }
        }
        else {
            Route::throwException();
        }
    }

    static function throwException()
    {
        include 'app/controllers/ExceptionController.php';
        $controller = new ExceptionController();
        $controller->index();
    }

}