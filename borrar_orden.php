<?php
session_start();
require "connection.php";

if (isset($_GET["order"])) {
    $sql = "DELETE from orden_de_servicio where numero_de_orden = " . $_GET["order"];
    if (mysqli_query($conn, $sql)) {
        $_SESSION['orden_borrada'] = "Orden borrada";
        header("Location: form_editar_orden.php");
    } else {
        $_SESSION['orden_no_borrada'] = "No se pudo borrar: " . mysqli_error($conn);
        header("Location: form_editar_orden.php");
    }
} else {
    $_SESSION['orden_no_borrada'] = "No se pudo borrar.";
    header("Location: form_editar_orden.php");
}
