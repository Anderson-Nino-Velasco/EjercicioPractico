<?php
require "connection.php";
session_start();




?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Generar reportes</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <header>
        <h1>Generar reportes</h1>
        <h13><a href='index.php'>Volver</a></h13>
    </header>
    <section>
        <form action="generar_reporte.php" method="post">
            <table>
                <tr>
                    <td>
                        <label for="fechainicio" class="class1">Desde</label>
                        <input type="date" name="fechainicio" id="fechainicio">
                    </td>
                    <td>
                        <label for="fechafin" class="class1">Hasta</label>
                        <input type="date" name="fechafin" id="fechafin">
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" value="Generar" />
                    </td>
                </tr>
            </table>
        </form>
        <table>
            <tr>
                <th>Fecha</th>
                <th>Cliente</th>
                <th>Placa</th>
                <th>Número de orden</th>
                <th>Tipo de orden</th>
                <th>Item</th>
                <th>Cantidad</th>
                <th>Valor unitario</th>
            </tr>
            <?php 
            if (isset($_SESSION['reporte_pass'])) {
                $sql = $_SESSION['reporte_pass'];
                $result = mysqli_query($conn, $sql);

                while($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>".$row['fecha']."</td>";
                    echo "<td>-</td>";
                    echo "<td>".$row['vehiculo']."</td>";
                    echo "<td>".$row['numero_de_orden']."</td>";
                    echo "<td>".$row['tipo_orden']."</td>";
                    echo "<td>-</td>";
                    echo "<td>-</td>";
                    echo "<td>-</td>";
                    echo "</tr>";
                }

                $sql = "SELECT * from vehiculos";
                unset($_SESSION['reporte_pass']);

            }
            ?>

        </table>
    </section>
    <tr>
        <td></td>
    </tr>

    <footer>
        <table>
            <?php
            if (isset($_SESSION['reporte_no_pass'])) {
                echo '<tr><td><p>' . $_SESSION['reporte_no_pass'] . '</p></td></tr>';
                unset($_SESSION['reporte_no_pass']);
            }
            
            ?>
        </table>
    </footer>


</body>

</html>