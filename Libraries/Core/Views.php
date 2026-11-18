<?php

class Views
{
    public function render($controller, $view, $data = [])
    {
        $name = is_object($controller) ? str_replace("Controller", "", get_class($controller)) : $controller;
        $viewPath = "Views/{$name}/{$view}.php";
        if (!file_exists($viewPath)) {
            throw new RuntimeException("No existe la vista {$viewPath}");
        }
        $controller = $name;
        $view = $viewPath;
        require "Views/Layout/main.php";
    }
}
