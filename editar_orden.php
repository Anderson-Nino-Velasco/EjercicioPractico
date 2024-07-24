<?php

session_start();
require_once "connection.php";


$placa = strtoupper($_POST['placa']);

$vehiculo = strtoupper($_POST['vehiculo']);
$tipo = ucfirst($_POST['tipo']);
$fecha = $_POST['fecha'];


$allData = array();

if (strcmp($placa, 'TODO') == 0) {
    $sql = "SELECT * from orden_de_servicio";
} elseif (strcmp($placa, 'CREAR') == 0) {
    header('Location: form_crear_vehiculo.php');
    exit();
} else {
    $sql = "SELECT * from orden_de_servicio where vehiculo = '" . $placa . "'";
}



$result = mysqli_query($conn, $sql);

while ($row = mysqli_fetch_assoc($result)) {
    $allData[] = $row['numero_de_orden'];
}



if ($result) {
    $_SESSION['order_found'] = $allData;
} else {
    $_SESSION['order_not_found'] = -1;
}

header('Location: form_editar_orden.php');
