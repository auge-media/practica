<?php

Flight::route('POST /update-contacto', function () {
    $nombre_contacto=(Flight::request()->data->nombre_contacto);
    $correo_contacto=(Flight::request()->data->correo_contacto);
    $telefono_contacto=(Flight::request()->data->telefono_contacto);
    $mensaje_contacto=(Flight::request()->data->mensaje_contacto);
    $id_contacto=(Flight::request()->data->id_contacto);
    
    $nombre_contacto=limpiar_cadena($nombre_contacto);
    $correo_contacto=limpiar_cadena($correo_contacto);
    $telefono_contacto=limpiar_cadena($telefono_contacto);
    $mensaje_contacto=limpiar_cadena($mensaje_contacto);
    $id_contacto=limpiar_cadena($id_contacto);

    # Verificando campos obligatorios #
    if ($nombre_contacto=="" || $correo_contacto=="" || $telefono_contacto=="" || $mensaje_contacto=="" ) {
        Flight::json("No has llenado todos los campos que son Obligatorios");
        exit();
    }

    # Verificando Integridad de los datos #
    if (verificar_datos("[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,$#\-\/ ]{4,70}", $nombre_contacto)) {
        Flight::json("El Nombre No Coincide Con El Formato Solicitado");
        exit();
    }
    
    if (!filter_var($correo_contacto, FILTER_VALIDATE_EMAIL)) {
        Flight::json("El Correo No Coincide Con El Formato Solicitado");
        exit();
    }
    
    if (verificar_datos("[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,$#\-\/ ]{9,70}", $telefono_contacto)) {
        Flight::json("El Teléfono No Coincide Con El Formato Solicitado");
        exit();
    }

    // Obtener la longitud del mensaje
    $longitud_mensaje = strlen($mensaje_contacto);

    // Verificar si la longitud del mensaje está dentro del rango permitido
    if ($longitud_mensaje < 4 || $longitud_mensaje > 800) {
        // Mostrar un mensaje de error si la longitud del mensaje no está dentro del rango permitido
        Flight::json("El Mensaje debe tener una longitud mínima de 4 caracteres y una longitud máxima de 800 caracteres.");
        exit();
    }

    // Actualizacion de datos SQL
    $sql = "UPDATE contactos SET nombre_contacto = ?, correo_contacto = ?, telefono_contacto = ?, mensaje_contacto = ? WHERE id_contacto = ?";
    $sentencia = Flight::db()->prepare($sql);
    $sentencia->bindParam(1, $nombre_contacto);
    $sentencia->bindParam(2, $correo_contacto);
    $sentencia->bindParam(3, $telefono_contacto);
    $sentencia->bindParam(4, $mensaje_contacto);
    $sentencia->bindParam(5, $id_contacto);

    $sentencia->execute();

    Flight::json("Datos de Contacto Actualizados");
    //Flight::json($nombre_contacto . " " . $correo_contacto . " " . $telefono_contacto . " " . $mensaje_contacto . " " . $id_contacto);
});