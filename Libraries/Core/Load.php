<?php

$controllerFile = "Controllers/{$controller}Controller.php";
$validNames = preg_match("/^[A-Za-z][A-Za-z0-9]*$/", $controller) && preg_match("/^[A-Za-z][A-Za-z0-9_]*$/", $method);

if ($validNames && file_exists($controllerFile)) {
    require_once $controllerFile;
    $controllerClass = "{$controller}Controller";
    if (class_exists($controllerClass) && method_exists($controllerClass, $method)) {
        $reflection = new ReflectionMethod($controllerClass, $method);
        $routable = $reflection->isPublic()
            && !$reflection->isStatic()
            && $reflection->getDeclaringClass()->getName() !== "Controller"
            && !($reflection->getNumberOfRequiredParameters() > 0 && $params === "");
        if ($routable) {
            $controllerObject = new $controllerClass();
            $controllerObject->$method($params);
            return;
        }
    }
}

(new ErrorController())->index();
