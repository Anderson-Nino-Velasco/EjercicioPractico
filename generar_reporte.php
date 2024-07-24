<?php
session_start();
require "connection.php";



$fechainicio = $_POST["fechainicio"];
$fechafin = $_POST["fechafin"];
$errores = "";

if (empty($fechainicio) || empty($fechafin)) {
    $errores .= 'Es necesario ingresar fechas válidas. </br>';
}

if ($fechainicio > $fechafin) {
    $errores .= 'La fecha final no puede ocurrir antes de la fecha inicial. </br>';
}

if (empty($errores)) {

    $sql = "SELECT * FROM orden_de_servicio WHERE orden_de_servicio.fecha BETWEEN '".$fechainicio."' AND '".$fechafin."' ORDER BY orden_de_servicio.fecha ASC";

    if (mysqli_query($conn, $sql)) {
        $_SESSION['reporte_pass'] = $sql;
        header('Location: form_generar_reporte.php');
    } else {
        $_SESSION['reporte_no_pass'] = 'No se pudo agregar una nueva orden: </br>' . $errores;
        header('Location: form_generar_reporte.php');
    }
} else {
    $_SESSION['reporte_no_pass'] = '<br/>No se pudo agregar una nueva orden: </br>' . $errores;
    header('Location: form_generar_reporte.php');
}
