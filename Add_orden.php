<?php

session_start();
require_once "connection.php";


$vehiculo = strtoupper($_POST['vehiculo']);
$tipo = ucfirst($_POST['tipo']);
$fecha = $_POST['fecha'];
$errores = "";

if (strcmp($vehiculo, 'INVALID') == 0) {
    $errores .= "Es necesario escoger un vehículo de la lista desplegable. </br>";
}
if (strcmp($tipo,'Invalid') == 0) {
    $errores .= 'Se necesita conocer el tipo de tarea a realizar. </br>';
}
if (empty($fecha)) {
    $errores .= 'Se necesita ingresar una fecha válida. </br>';
}

if(empty($errores)){    
    $sql = "SELECT * FROM vehiculos WHERE placa = '".$vehiculo."'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result);
    if (strcmp('inactivo', $row['estado']) == 0) {
        $errores .= 'El vehículo '.$vehiculo.' se encuentra inactivo. </br>';
    }
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


