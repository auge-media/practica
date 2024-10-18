<?php

Flight::route('GET /read-contactos/@id', function ($id) {
    $sentencia = Flight::db()->prepare("SELECT * FROM `contactos` WHERE id_contacto = ? LIMIT 1");
    
    $sentencia->bindParam(1, $id);
    
    $sentencia->execute();
    $datos = $sentencia->fetch(PDO::FETCH_ASSOC);

    Flight::json($datos);

});