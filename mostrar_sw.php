<?php

    //Constantes
define ("__HOST__", "localhost");
define ("__DB__", "farmacia");
define ("__USER__", "root");
define ("__PASS__", "");

$json = array();

$conexion = mysqli_connect(__HOST__, __USER__, __PASS__, __DB__);

$consulta_mostrar = "SELECT * FROM medicamento";
$resultado_mostrar = mysqli_query($conexion, $consulta_mostrar) or die ("ERROR".mysql_error($conexion));

if($resultado_mostrar == true){
    while($registro = mysqli_fetch_array($resultado_mostrar)){
        $json["medicamento"][] = $registro;
    }

    echo json_encode($json);
    mysqli_close($conexion);
} else {
    $resuldo_negativo["nombre_medicamento"] = "ERROR";
    $resuldo_negativo["cantidad"] = "ERROR";
    $resuldo_negativo["precio"] = "ERROR";
    $resuldo_negativo["fecha_vencimiento"] = "ERROR";

    $jsonArray["medicamento"] = $resuldo_negativo;
    echo json_encode($json);
}

?>