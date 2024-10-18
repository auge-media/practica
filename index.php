<?php
header('Content-Type: text/html; charset=utf-8');
mb_internal_encoding('UTF-8');

require './main.php';
require './flight/Flight.php';

$conexion=conexion();

// Ruta por Defecto en la api, es la primera ruta
Flight::route('/', function () {
    echo 'Hola Mundo!';
});

/* API CON CONTACTOS */

// Validar los datos de entrega
require './contactos/post-send-contacto.php';

// Lectura de los registros de contacto existentes
require './contactos/get-read-contactos.php';

// Lectura de los registros de contacto existentes de un solo registro
require './contactos/get-read-contacto.php';

// Borrar registro de la tabla de contacto mediante peticion DELETE
require './contactos/detelete-delete-contacto.php';

// Actualizar registro de la tabla de contacto mediante peticion PUT
require './contactos/post-update-contacto.php';

// Lectura de los registros de contactos en base a una busqueda
require './contactos/get-search-contactos.php';

Flight::start();