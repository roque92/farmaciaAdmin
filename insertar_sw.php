<?php
//Variables
$host = "localhost";
$db = "farmacia";
$user = "root";
$pass = "";

//Constantes
define ("__HOST__", "localhost");
define ("__DB__", "farmacia");
define ("__USER__", "root");
define ("__PASS__", "");


$jsonArray = array();

//isset comprueba si hay una variable definida en DB
if (isset($_GET["nombre_medicamento"]) && isset($_GET["cantidad"]) 
&& isset($_GET["precio"]) && isset($_GET["fecha_vencimiento"])){

    $nombre_medicamento = $_GET["nombre_medicamento"];
    $cantidad = $_GET["cantidad"];
    $precio = $_GET["precio"];
    $fecha_vencimiento = $_GET["fecha_vencimiento"];

    //conversion de fecha
    $fechaConvertida = strtotime ($fecha_vencimiento);
    $fechaConvertida = date ('Y/m/d', $fechaConvertida);

$conexion = mysqli_connect(__HOST__, __USER__, __PASS__, __DB__);

$insertar = "INSERT INTO medicamento (nombre_medicamento, cantidad, precio, fecha_vencimiento)
            VALUES ('{$nombre_medicamento}', {$cantidad}, {$precio}, '{$fechaConvertida}')";

$resuldato_consulta = mysqli_query($conexion, $insertar)or die ('Error'.mysql_error($conexion));

$jsonArray["medicamento"][] = $resuldato_consulta;

mysqli_close($conexion);
echo json_encode($jsonArray);

} else {
    $resuldo_negativo["nombre_medicamento"] = "ERROR";
    $resuldo_negativo["cantidad"] = "ERROR";
    $resuldo_negativo["precio"] = "ERROR";
    $resuldo_negativo["fecha_vencimiento"] = "ERROR";

    $jsonArray["medicamento"][] = $resuldo_negativo;
    echo json_encode($jsonArray);
}
?>