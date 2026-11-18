<?php

chdir(__DIR__);

require_once "Config/Config.php";
require_once "Helpers/Helpers.php";

require_once "Libraries/Core/Autoload.php";

$url = trim($_GET["url"] ?? "", "/");
$arrUrl = $url === "" ? [] : explode("/", $url);

$controller = studly($arrUrl[0] ?? "Home");
$method = $arrUrl[1] ?? "index";

$params = implode(",", array_slice($arrUrl, 2));

require_once "Libraries/Core/Load.php";
