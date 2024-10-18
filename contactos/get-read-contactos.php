<?php

Flight::route('GET /read-contactos', function () {
    $sentencia = Flight::db()->prepare("SELECT * FROM `contactos`");
    
    $sentencia -> execute();
    $datos= $sentencia->fetchAll(PDO::FETCH_ASSOC);

    Flight::json($datos);

});