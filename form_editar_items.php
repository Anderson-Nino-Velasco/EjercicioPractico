<?php
require "connection.php";
session_start();
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
    <h1>Editar órdenes de servicio</h1>
    <h13><a href = 'form_editar_orden.php'>Volver</a></h13>        
    </header>
    <section>
        <table>
            <tr>
                <td colspan = "4"><?php
                if(isset($_GET['order'])){
                    $order = $_GET['order'];
                }else{
                    $order = 'INVALID';
                }
                echo "<h3>Orden número ".$order."</h3>";
                ?></td>
            </tr>
            <form action="editar_orden.php" method="post">    
                <tr>
                    <th>Items</th>
                    <th>Costo unitario</th>
                    <th>Cantidad</th>
                    <th>Funciones</th>
                </tr>
                <?php

                $sql = "SELECT * from items_orden_de_servicio where ordenservicioid = '".$order."'";
                $result = mysqli_query($conn, $sql);

                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . $row['descripcion'] . "</td>";
                    echo "<td>" . $row['valor_unitario'] . "</td>";
                    echo "<td>" . $row['cantidad'] . "</td>";
                    echo "<td><a href='borrar_items.php?id=" . $row['id'] . "'>Borrar</a></td>";
                    echo "</tr>";
                }
                ?>
        </table>
        </form>
    </section>
    <section>
        <table><form action=<?php echo "editar_items.php?order=".$_GET['order'];?> method="post">
            <tr>
                <th>
                    <label for="item" class="class1">Item</label>
                    <input type="text" name="item" id="item">
                </th>
                <th>
                    <label for="unitcost" class="class1">Costo unitario</label>
                    <input type="number" name="unitcost" id="unitcost">
                </th>
                <th>
                    <label for="cantidad" class="class1">Cantidad</label>
                    <input type="number" name="cantidad" id="cantidad">
                </th>
            </tr>
            <tr>
                <td colspan="3"><input type="submit" value="Añadir"/></td>
            </tr></form>
        </table>
    </section>

    <footer>
        <table>
            <?php
            if (isset($_SESSION['item_agregado'])) {
                echo '<tr><td><p>' . $_SESSION['item_agregado'] . '</p></td></tr>';
                unset($_SESSION['item_agregado']);
            }
            if (isset($_SESSION['item_no_agregado'])) {
                echo '<tr><td><p>' . $_SESSION['item_no_agregado'] . '</p></td></tr>';
                unset($_SESSION['item_no_agregado']);
            }
            ?>
        </table>
    </footer>


</body>

</html>