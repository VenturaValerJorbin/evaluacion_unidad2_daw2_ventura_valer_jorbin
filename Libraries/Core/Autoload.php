<?php

spl_autoload_register(function ($className) {
    foreach (["Libraries/Core/", "Controllers/", "Models/"] as $carpeta) {
        $filePath = "{$carpeta}{$className}.php";
        if (file_exists($filePath)) {
            require_once $filePath;
            return;
        }
    }
});
