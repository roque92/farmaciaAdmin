<?php

//Constantes
define ("__HOST__", "localhost");
define ("__DB__", "farmacia");
define ("__USER__", "root");
define ("__PASS__", "");

$json = array();

$conexion = mysqli_connect(__HOST__, __USER__, __PASS__, __DB__);

if(isset($_GET["id"])){
   
    $id = $_GET["id"];
    
    $consulta_eliminar = "DELETE FROM medicamento WHERE id = $id";
    $resultado_eliminar = mysqli_query($conexion, $consulta_eliminar) or die ("Error".mysql_error($conexion));

    if($resultado_eliminar == true){

        //repuesta pues de la consulta con la que vamos a trabajar en android

        $json ["medicamento"] =  $resultado_eliminar;
        echo json_encode ($json);
        mysqli_close($conexion);

    } else {
        $resuldo_negativo["nombre_medicamento"] = "ERROR";
        $resuldo_negativo["cantidad"] = "ERROR";
        $resuldo_negativo["precio"] = "ERROR";
        $resuldo_negativo["fecha_vencimiento"] = "ERROR";

        $jsonArray["medicamento"] = $resuldo_negativo;
        echo json_encode($json);

    }
}
?>