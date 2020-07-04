<?php

    //Constantes
    define ("__HOST__", "localhost");
    define ("__DB__", "farmacia");
    define ("__USER__", "root");
    define ("__PASS__", "");

    $json = array();

    $conexion = mysqli_connect(__HOST__, __USER__, __PASS__, __DB__);

    if(isset($_GET["nombre_medicamento"]) && isset($_GET["cantidad"])
    && isset($_GET["precio"]) && isset($_GET["fecha_vencimiento"]) 
    && isset($_GET["id"])) {

        $nombre_medicamento = $_GET["nombre_medicamento"];
        $cantidad = $_GET["cantidad"];
        $precio = $_GET["precio"];
        $fecha_vencimiento = $_GET["fecha_vencimiento"];
        $id = $_GET["id"];

        //conversion de fecha
        $fechaConvertida = strtotime ($fecha_vencimiento);
        $fechaConvertida = date ('Y/m/d', $fechaConvertida);

        $consulta_modificar = "UPDATE medicamento SET nombre_medicamento ='$nombre_medicamento', cantidad = $cantidad, precio = $precio, fecha_vencimiento = '$fechaConvertida' WHERE id = $id;";
        $resultado_consulta = mysqli_query ($conexion, $consulta_modificar) or die ('Error'.mysql_error($conexion));

        $json ["medicamento"][] = $resultado_consulta;

        mysqli_close($conexion);
        echo json_encode($json);

    } else {
        $resuldo_negativo["nombre_medicamento"] = "ERROR";
        $resuldo_negativo["cantidad"] = "ERROR";
        $resuldo_negativo["precio"] = "ERROR";
        $resuldo_negativo["fecha_vencimiento"] = "ERROR";

        $jsonArray["medicamento"] = $resuldo_negativo;
        echo json_encode($json);
        }

?>