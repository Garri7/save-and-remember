<?php

    include("conexion.php");
    include("funciones.php");

    $query = "";
    $salida = array();
    $query = "SELECT * FROM utiles ";
    $index = $_REQUEST["order"][0]['column'];

    if (isset($_POST["search"]["value"])) {
       $query .= 'WHERE articulo LIKE "%' . $_POST["search"]["value"] . '%" ';
       $query .= 'OR ubicacion LIKE "%' . $_POST["search"]["value"] . '%" ';
    }

    if (isset($_POST["order"])) {
        $query .= 'ORDER BY' . $_POST['order'][$index]['column'] .' '.$_POST['order'][0]['dir'] . ' ';        
    }else{
        $query .= 'ORDER BY id DESC ';
    }

    if($_POST["length"] != -1){
        $query .= 'LIMIT ' . $_POST["start"] . ','. $_POST["length"];
    }
    $stmt = $conexion->prepare($query);
    $stmt->execute();
    $resultado = $stmt->fetchAll();
    $datos = array();
    $filtered_rows = $stmt->rowCount();
    foreach($resultado as $fila){
        $imagen = '';
        if($fila["imagen"] != ''){
            $imagen = '<a data-lightbox="roadtrip" href="img/'.$fila["imagen"] .'"><img src="img/' . $fila["imagen"] . '"  class=" data-lightbox="roadtrip" img-thumbnail" width="50" height="35" /></a>';
        }else{
            $imagen = '';
        }

        $sub_array = array();
        $sub_array[] = $fila["id"];
        $sub_array[] = strtoupper($fila["articulo"]);
        $sub_array[] = $fila["ubicacion"];
        
      
        $sub_array[] = $imagen;
        $sub_array[] = $fila["fecha_creacion"];
        $sub_array[] = '<button type="button" name="editar" id="'.$fila["id"].'" class="btn btn-warning btn-xs editar"><i class="bi bi-pencil-square"></i> Editar</button>';
        $sub_array[] = '<button type="button" name="borrar" id="'.$fila["id"].'" class="btn btn-danger btn-xs borrar"><i class="bi bi-trash"></i> Borrar</button>';
        $datos[] = $sub_array;
    }

    $salida = array(
        "draw"               => intval($_POST["draw"]),
        "recordsTotal"       => $filtered_rows,
        "recordsFiltered"    => obtener_todos_registros(),
        "data"               => $datos,
    );

    echo json_encode($salida);