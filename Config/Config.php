<?php

const DB_HOST = "localhost";
const DB_PORT = "3320";
const DB_NAME = "evaluacion_daw2";
const DB_USER = "root";
const DB_PASS = "357951";
const DB_CHARSET = "utf8mb4";

const APP_NAME = "Sistema Web";

const DEBUG = true;

$esquema = (!empty($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] !== "off") ? "https" : "http";
$host = $_SERVER["HTTP_HOST"] ?? "localhost";
$carpeta = rtrim(str_replace("\\", "/", dirname($_SERVER["SCRIPT_NAME"] ?? "")), "/.");
$carpeta = implode("/", array_map("rawurlencode", explode("/", $carpeta)));
define("BASE_URL", $esquema . "://" . $host . $carpeta);
