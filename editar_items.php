<?php
session_start();
require "connection.php";



$item = $_POST["item"];
$unitcost = $_POST["unitcost"];
$cantidad = $_POST["cantidad"];
$ordenservicio = $_GET["order"];


$errores = "";

if (strlen($item) <= 0) {
    $errores .= "Es necesario ingresar una descripción del item. </br>";
}
if ($unitcost < 0) {
    $errores .= 'El precio unitario es inválido. </br>';
}
if ($cantidad <= 0) {
    $errores .= 'Debe agregar por lo menos un objeto. </br>';
}
if (!is_numeric($ordenservicio)) {
    $errores .= 'Error leyendo el código de la orden de servicio. </br>';
}

if(empty($errores)){
    $sql = "SELECT * FROM items_orden_de_servicio WHERE descripcion = '".$item."'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result);

    $str1 = strtoupper($item);
    $str2 = strtoupper($row['descripcion']);

    if (strcmp($str1, $str2) == 0) {
        $errores .= 'El item '.$item.' ya se encuentra en la orden. </br>';
    }
}


if (empty($errores)) {
    $sql = "INSERT INTO items_orden_de_servicio VALUES(null,'$ordenservicio','$item','$cantidad','$unitcost')";
    if (mysqli_query($conn, $sql)) {
        $_SESSION['item_agregado'] = '¡Se agregó un nuevo item para la orden de servicio número ' . $ordenservicio . '!';
        header('Location: form_editar_items.php?order=' . $ordenservicio);
    } else {
        $_SESSION['item_no_agregado'] = 'No se pudo agregar item: </br>' . $errores;
        header('Location: form_editar_items.php?order=' . $ordenservicio);
    }
} else {
    $_SESSION['item_no_agregado'] = 'No se pudo agregar item: </br>' . $errores;
    header('Location: form_editar_items.php?order=' . $ordenservicio);
}
