<?php

Flight::route('GET /search-contactos/', function () {
    $sentencia = Flight::db()->prepare("SELECT * FROM `contactos`");

    $sentencia -> execute();
    $datos= $sentencia->fetchAll(PDO::FETCH_ASSOC);

    Flight::json($datos);
});

Flight::route('GET /search-contactos/@id', function ($id) {
    $sentencia = Flight::db()->prepare("SELECT * FROM `contactos` WHERE 
    `id_contacto` LIKE ? OR `nombre_contacto` LIKE ? OR `correo_contacto` LIKE ? OR `telefono_contacto` LIKE ?  OR `mensaje_contacto` LIKE ? ");
    
    // Vincular el valor de búsqueda con el comodín % en cada parámetro
    $busqueda = "%{$id}%";
    $sentencia->bindParam(1, $busqueda);
    $sentencia->bindParam(2, $busqueda);
    $sentencia->bindParam(3, $busqueda);
    $sentencia->bindParam(4, $busqueda);
    $sentencia->bindParam(5, $busqueda);
        
    // Ejecutar la consulta SQL y devolver los resultados como JSON
    $sentencia->execute();
    $datos = $sentencia->fetchAll(PDO::FETCH_ASSOC);
    Flight::json($datos);
});