<?php
require "connection.php";
session_start();
$sql = "SELECT * from vehiculos";
$result = mysqli_query($conn, $sql);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Vehículos</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <header>
        <h1>Administración de vehículos</h1>
        <h13><a href = 'index.php'>Volver</a></h13> 
    </header>
    <section>
        <table>
            <tr>
                <th>Placa</th>
                <th>Tipo Vehículo</th>
                <th>Kilometráje</th>
                <th>Estado</th>
                <th>Propietario</th>
            </tr>
            <?php
                if (mysqli_num_rows($result) > 0){
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>".$row['placa']."</td>";
                        echo "<td>".$row['tipo_vehiculo']."</td>";
                        echo "<td>".$row['kilometraje']."</td>";
                        echo "<td>".$row['estado']."</td>";
                        echo "<td>".$row['propietario']."</td>";
                        echo "</tr>";
                    }
                }else{
                    echo 
                        "<tr>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                        </tr>";
                }
            ?>
        </table>
    </section>
    <section>
        <table>
            <form action="crear_vehiculo.php" method="post">
                <tr>
                    <th>
                        <label for="placa" class="class1">Placa</label>
                        <input type="text" name="placa" id="placa">
                    </th>
                    <th>
                        <label for="tipo" class="class1">Tipo Vehículo</label>
                        <select name="tipo" id="tipo">
                            <option value="invalid">-</option>
                            <option value="automovil">Automóvil</option>
                            <option value="bus">Bus</option>
                            <option value="buseta">Buseta</option>
                            <option value="camion">Camión</option>
                            <option value="camioneta">Camioneta</option>
                            <option value="campero">Campero</option>
                            <option value="microbus">Microbus</option>
                            <option value="tractocamion">Tractocamión</option>
                            <option value="moto">Moto</option>
                            <option value="motocarro">Motocarro</option>
                            <option value="mototriciclo">Mototriciclo</option>
                            <option value="cuatrimoto">Cuatrimoto</option>
                            <option value="volqueta">Volqueta</option>
                        </select>   
                    </th>
                    <th>
                        <label for="kilometraje" class="class1">Kilometráje</label>
                        <input type="number" name="kilometraje" id="kilometraje">
                    </th>
                    <th>
                        <label for="estado" class="class1">Estado</label>
                        <select name="estado" id="estado">
                            <option value="invalid">-</option>
                            <option value="activo">Activo</option>
                            <option value="inactivo">Inactivo</option>
                        </select>                       
                    </th>
                    <th>
                        <label for="propietario" class="class1">Propietario</label>
                        <input type="text" name="propietario" id="propietario">
                    </th>
                </tr>
                <tr>
                    <th colspan="5"><input type="submit" value="Añadir" /></th>
                </tr>
            </form>
        </table>
    </section>
    <footer>
        <table>
        <?php 
            if (isset($_SESSION['vehiculos_false'])) {
                echo '<tr><td><p>' . $_SESSION['vehiculos_false'] . '</p></td></tr>';
                unset($_SESSION['vehiculos_false']);
            }
        ?>
        </table>
    </footer>


</body>

</html>