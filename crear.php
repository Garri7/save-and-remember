<?php

include("conexion.php");
include("funciones.php");

// crear desde el front

if ($_POST["operacion"] == "Crear") {
    $imagen = '';
    if ($_FILES["imagen_usuario"]["name"] != '') {
        $imagen = subir_imagen();
    }
    $stmt = $conexion->prepare("INSERT INTO utiles(articulo, ubicacion, imagen)VALUES(:articulo, :ubicacion, :imagen)");

    $resultado = $stmt->execute(
        array(
            ':articulo'    => $_POST["articulo"],
            ':ubicacion'    => $_POST["ubicacion"],
            ':imagen'    => $imagen
        )
    );

    if (!empty($resultado)) {
        echo 'Registro creado';
    }
}

// Editar/ actulizar base de datos

if ($_POST["operacion"] == "Editar") {
    $imagen = '';
    if ($_FILES["imagen_usuario"]["name"] != '') {
        $imagen = subir_imagen();
    }else{
        $imagen = $_POST["imagen_usuario_oculta"];
    }


    $stmt = $conexion->prepare("UPDATE utiles SET articulo=:articulo, ubicacion=:ubicacion, imagen=:imagen WHERE id = :id");

    $resultado = $stmt->execute(
        array(
            ':articulo'    => $_POST["articulo"],
            ':ubicacion'    => $_POST["ubicacion"],
            ':imagen'    => $imagen,
            ':id'    => $_POST["id_usuario"]
        )
    );

    if (!empty($resultado)) {
        echo 'Registro actualizado';
    }
}