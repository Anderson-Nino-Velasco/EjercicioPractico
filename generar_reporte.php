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

if(empty($errores)){
    
    $sql = "INSERT INTO orden_de_servicio VALUES(null,'$vehiculo','$tipo','$fecha')";
    if(mysqli_query($conn, $sql)) {
        $errores .= strcmp($row['estado'], 'inactivo') == 0;
        $_SESSION['Orden_ingresada'] = '¡Se agregó una nueva orden para el vehículo '.$vehiculo.'!';
        header('Location: form_editar_orden.php');
    }else{
        $_SESSION['Orden_no_ingresada'] = 'No se pudo agregar una nueva orden: </br>'.$errores;
        header('Location: form_editar_orden.php');
    }

}else{
    $_SESSION['Orden_no_ingresada'] = '<br/>No se pudo agregar una nueva orden: </br>'.$errores;
    header('Location: form_editar_orden.php');
}
