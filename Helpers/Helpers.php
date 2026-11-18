<?php

function debug($param)
{
    echo "<pre>";
    var_dump($param);
    echo "</pre>";
}

function e($valor)
{
    return htmlspecialchars((string)$valor, ENT_QUOTES, "UTF-8");
}

function url($ruta = "")
{
    return BASE_URL . ($ruta === "" ? "" : "/" . ltrim($ruta, "/"));
}

function studly($texto)
{
    $texto = ucwords(strtolower(str_replace(["-", "_"], " ", $texto)));
    return str_replace(" ", "", $texto);
}
