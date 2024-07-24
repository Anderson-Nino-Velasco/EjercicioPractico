<?php
session_start();
require "connection.php";


if (isset($_GET["id"])) {
    $sql = "SELECT * FROM items_orden_de_servicio WHERE id = " . $_GET["id"];
    if($result = mysqli_query($conn, $sql)){
        $row = mysqli_fetch_array($result);
        $sql = "DELETE from items_orden_de_servicio where id = " . $_GET["id"];
        if (mysqli_query($conn, $sql)) {
            $_SESSION['item_borrado'] = "Item borrado.";

            header("Location: form_editar_items.php?order=".$row['ordenservicioid']);
        } else {
            $_SESSION['item_no_borrado'] = "No se pudo borrar el item: " . mysqli_error($conn);
            header("Location: index.php");
        }

    }else{
        $_SESSION['item_no_borrado'] = "No se pudo encontrar el item: " . mysqli_error($conn);
        header("Location: index.php");
    }
    




    
} else {
    $_SESSION['item_no_borrado'] = "No se pudo conseguir el id del item.";
    header("Location: form_editar_items.php");
}
