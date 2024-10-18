<?php

Flight::route('DELETE /delete-contacto', function () {
    $id_contacto=(Flight::request()->data->id_contacto);

    $sql="DELETE FROM `contactos` WHERE id_contacto = ?";
    $sentencia = Flight::db()->prepare($sql);
    $sentencia->bindParam(1, $id_contacto);

    $sentencia->execute();

    Flight::json("Contacto Eliminado");

});