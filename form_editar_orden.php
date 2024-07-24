<?php
require "connection.php";
session_start();
$sql = "SELECT * from vehiculos";
$result = mysqli_query($conn, $sql);
$orderData = 0;


if (isset($_SESSION['order_found'])) {
    $orderData = $_SESSION['order_found'];
    unset($_SESSION['order_found']);
}

if (isset($_SESSION['order_not_found'])) {
    $orderData = $_SESSION['order_not_found'];
    unset($_SESSION['order_not_found']);
}



?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear órden de servicio</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <header>
        <h1>Administrar órdenes de servicio</h1>
        <h13><a href = 'index.php'>Volver</a></h13> 
    </header>
    <section>
        <table>
            <form action="editar_orden.php" method="post">
                <tr>
                    <td colspan="4" style="text-align: left;">
                        <label for="placa" class="class2">Vehículo: </label>
                        <select name="placa" id="placa">
                            <option value="todo">-- Ver todos --</option>
                            <option value="crear">-- Crear --</option>
                            <?php
                            $sql = "SELECT * from vehiculos";
                            $result = mysqli_query($conn, $sql);
                            if (mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo "<option value='" . $row['placa'] . "'>" . $row['placa'] . "</option>";
                                }
                            } ?>
                        </select>
                    </td>
                    <td>
                        <input type="submit" value="Buscar" />
                    </td>
                </tr>

                <tr>
                    <th>Número de órden</th>
                    <th>Vehículo</th>
                    <th>Tipo</th>
                    <th>Fecha</th>
                    <th>Funciones</th>
                </tr>
                <?php

                $checking = 0;

                if (is_array($orderData)) {
                    if (sizeof($orderData) > 0) {
                        $checking = 1;
                    } else {
                        $checking = -1;
                    }
                } else {
                    $checking = 0;
                }

                if ($checking == 1) {
                    $orderNumbers = implode(",", $orderData);
                    $sql = "SELECT * FROM orden_de_servicio WHERE numero_de_orden IN (" . $orderNumbers . ")";
                    $result = mysqli_query($conn, $sql);
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . $row['numero_de_orden'] . "</td>";
                        echo "<td>" . $row['vehiculo'] . "</td>";
                        echo "<td>" . $row['tipo_orden'] . "</td>";
                        echo "<td>" . $row['fecha'] . "</td>";
                        echo "<td><a href='form_editar_items.php?order=" . $row['numero_de_orden'] . "'>Editar</a><a> / </a><a href='borrar_orden.php?order=" . $row['numero_de_orden'] . "'>Borrar</a></td>";
                        echo "</tr>";
                    }
                } else if ($checking == -1) {
                    echo
                    "<tr>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                        </tr>";
                } else {
                    $sql = "SELECT * FROM orden_de_servicio";
                    $result = mysqli_query($conn, $sql);
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . $row['numero_de_orden'] . "</td>";
                        echo "<td>" . $row['vehiculo'] . "</td>";
                        echo "<td>" . $row['tipo_orden'] . "</td>";
                        echo "<td>" . $row['fecha'] . "</td>";
                        echo "<td><a href='form_editar_items.php?order=" . $row['numero_de_orden'] . "'>Editar</a><a> / </a><a href='borrar_orden.php?order=" . $row['numero_de_orden'] . "'>Borrar</a></td>";
                        echo "</tr>";
                    }
                }
                ?>
        </table>
        </form>
    </section>
    <section>
        <table>
            <form action="Add_orden.php" method="post">
                <tr>
                    <th>
                        <label for="vehiculo" class="class1">Vehículo</label>
                        <select name="vehiculo" id="vehiculo">
                            <option value="invalid">--</option>
                            <?php
                            $sql = "SELECT * from vehiculos";
                            $result = mysqli_query($conn, $sql);
                            if (mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo "<option value='" . $row['placa'] . "'>" . $row['placa'] . "</option>";
                                }
                            } ?>
                        </select>
                    </th>
                    <th>
                        <label for="tipo" class="class1">Tipo</label>
                        <select name="tipo" id="tipo">
                            <option value="invalid">--</option>
                            <option value="correctivo">Correctivo</option>
                            <option value="preventivo">Preventivo</option>
                        </select>
                    </th>
                    <th>
                        <label for="fecha" class="class1">Fecha</label>
                        <input type="date" name="fecha" id="fecha">
                    </th>
                </tr>
                <tr>
                    <th colspan="3"><input type="submit" value="Añadir" /></th>
                </tr>
            </form>
        </table>
    </section>

    <footer>
        <table>
            <?php
            if (isset($_SESSION['Orden_no_ingresada'])) {
                echo '<tr><td><p>' . $_SESSION['Orden_no_ingresada'] . '</p></td></tr>';
                unset($_SESSION['Orden_no_ingresada']);
            }
            if (isset($_SESSION['Orden_ingresada'])) {
                echo '<tr><td><p>' . $_SESSION['Orden_ingresada'] . '</p></td></tr>';
                unset($_SESSION['Orden_ingresada']);
            }
            ?>
        </table>
    </footer>


</body>

</html>