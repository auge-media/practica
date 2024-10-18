<?php
header('Content-Type: text/html; charset=utf-8');
mb_internal_encoding('UTF-8');

// Habilitar CORS en PHP
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    http_response_code(200);
    exit();
}

require './main.php';
require './flight/Flight.php';

$conexion=conexion();

// Ruta por Defecto en la api, es la primera ruta
Flight::route('/', function () {
    echo 'Hola Mundo!';
});

/* API CON ALUMNOS */



Flight::start();