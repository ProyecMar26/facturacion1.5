<?php

// Establecer conexión a la base de datos
require "../php/conn.php";

// Verificar si se envió el formulario de nueva orden
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['accion']) && $_POST['accion'] == 'crear_orden') {
    require "../php/shopping/newOrden.php";
}

// Verificar si se envió el formulario de compra
if ($_SERVER["REQUEST_METHOD"] == "POST" && !isset($_POST['accion'])) {
    $nombre_producto = $_POST['nombre'];
    $cantidad = $_POST["cantidad"];
    $precio_compra = $_POST['precio_compra'];
    $persona = $_POST["persona"];
    $id_orden = $_POST["categoria"];  

    require "../php/shopping/idOrden.php";
}

$sql_ordenes_compra = "SELECT * FROM ordenes_compra ORDER BY id_orden ASC";
$resultado_ordenes_compra = $conn->query($sql_ordenes_compra);

?>

<!DOCTYPE html>
<html>
<head>
    <?php
    include "../php/head.php"
    ?>
    <title>Compras</title>
</head>
<body>
    <header>
        <?php include '../php/navbar.php'; ?>
        <main>
            <div class="boxShopping box">
                <h1>Compras</h1>
                <p>Agregar a una orden de compra</p>
                <form method="post" id="ventasForm">
                    <label for="nombre">Producto</label>
                    <input type="text" name="nombre" class="form"><br>
                    <label for="cantidad">Cantidad</label>
                    <input type="number" name="cantidad" class="form"><br>
                    <label for="precio_compra">Precio compra</label>
                    <input type="number" name="precio_compra" class="form"><br>
                    <label for="persona">Persona</label>
                    <input type="text" name="persona" class="form"><br>
                    <label for="categoria">N° Orden</label>
                    <select name="categoria" required>
                        <?php
                        if ($resultado_ordenes_compra && $resultado_ordenes_compra->num_rows > 0) {
                            while ($fila = $resultado_ordenes_compra->fetch_assoc()) {
                                echo "<option value=\"" . $fila["id_orden"] . "\">" . $fila["documento"] . "</option>";
                            }
                        } else {
                            echo "<option value=\"\">No hay órdenes de compra disponibles</option>";
                        }
                        ?>
                    </select><br>
                    <br><br>
                    <button type="submit" class="buttonSaveShopping">Guardar compra</button>
                    <br><br>
                </form>
            </div>
            <div class="boxShopping2 box">
                <form method="post" class="ventas_metodo" id="newOrderForm">
                    <label for="documento">Documento</label>
                    <input type="text" name="documento" required>
                    <input type="hidden" name="accion" value="crear_orden"><br>
                    <button type="submit">Nueva orden de compra</button>
                </form>
            </div>
            <div class="boxFacture box">
                <button id="printButton" onclick="printSales()">Generar Factura</button>
            </div>
            <div class="boxShoppingLeft box">
                <div class="order-list">
                    <h2>Órdenes de Compra</h2>
                    <?php
                    require '../php/shopping/shoppingOrders.php';
                    ?>
                </div>
            </div>
        </main>
    </header>
    <script>
        function toggleMenu() {
            var menu = document.getElementById('lista-menu');
            if (menu.style.display === 'block') {
                menu.style.display = 'none';
            } else {
                menu.style.display = 'block';
            }
        }
        function setOrderId(id) {
            // Store the selected order ID in localStorage or pass it directly to the print function
            localStorage.setItem('selectedOrderId', id);
        }

        function printSales() {
            var id_orden = localStorage.getItem('selectedOrderId');
            if (id_orden) {
                window.location.href = '../php/shopping/printShopping.php?id_orden=' + id_orden;
            } else {
                alert('Por favor, seleccione una orden de venta.');
            }
        }
    </script>
</body>
</html>
