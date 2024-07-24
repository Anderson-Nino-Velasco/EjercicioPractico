<?php

session_start();
require_once "connection.php";


$placa = $_POST['placa'];
$tipo = $_POST['tipo'];
$kilometraje = $_POST['kilometraje'];
$estado = $_POST['estado'];
$propietario = $_POST['propietario'];
$errors = "";

if(!empty($placa) && strlen($placa) === 6){
    $sql = "SELECT * from vehiculos where trim(upper(placa)) = trim(upper('".$placa."'))";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_num_rows($result);
    if ($row > 0) {
        $errores .= '- Esta placa ya esta registrada. <br/>';
    }
}else{
    $errores .= '- ¿La placa fue mal digitada?. <br/>';
}

if($tipo === 'invalid'){
    $errores .= '- ¿Cuál es el tipo del vehículo?. <br/>';
}
if(!is_numeric($kilometraje) && $kilometraje < 0){
    $errores .= '- El kilometraje debe ser mayor o igual a cero. <br/>';
}
if($estado === 'invalid'){
    $errores .= '- ¿Cuál es el estado del vehículo?. <br/>';
}
if(empty($propietario)){
    $errores .= '- ¿Quién es el propietario?. <br/>';
}



if(empty($errores)){
    $placa = strtoupper($placa);
    $tipo = ucfirst($tipo);

    $sql = "INSERT INTO vehiculos VALUES('$placa','$tipo','$kilometraje','$estado','$propietario')";

    if(mysqli_query($conn, $sql)) {
        $_SESSION['vehiculos_true'] = true;
        header("Location: index.php");
    }else{
        $_SESSION['vehiculos_false'] = false;
        header("Location: form_crear_vehiculo.php");
    }
}else{
    $_SESSION['vehiculos_false'] = $errores;
    header("Location: form_crear_vehiculo.php"); 
}





