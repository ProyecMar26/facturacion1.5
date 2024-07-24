<?php
require "../php/conn.php";

// Manejo del formulario de nueva orden de venta
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['accion']) && $_POST['accion'] == 'crear_orden') {
    require "../php/sales/createSales.php";
}

// Manejo del formulario de guardar venta
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['accion']) && $_POST['accion'] == 'guardar_venta') {
    require "../php/sales/saveSales.php";
}

// Consulta de órdenes de venta existentes
require "../php/sales/consultSalesOrders.php";
?>

<!DOCTYPE html>
<html>
<head>
    <?php include "../php/head.php"; ?>
    <title>Ventas</title>
</head>
<body>
    <header>
        <?php include '../php/navbar.php'; ?>
        <main>
            <div class="boxSales">
                <h1>Ventas</h1>
                <p>Agregar a una orden de venta</p>
                <!-- Formulario para agregar ventas -->
                <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" id="ventasForm">
                    <label for="nombre">Producto</label>
                    <input type="text" name="nombre" class="form" id="nombre" required>
                    <label for="cantidad">Cantidad</label>
                    <input type="number" name="cantidad" class="form" id="cantidad" required>
                    <label for="categoria">N° Orden</label>
                    <select name="categoria" required>
                        <?php
                        if ($resultado_ordenes_venta && $resultado_ordenes_venta->num_rows > 0) {
                            while ($fila = $resultado_ordenes_venta->fetch_assoc()) {
                                echo "<option value=\"" . $fila["id_orden"] . "\">" . $fila["documento"] . "</option>";
                            }
                        } else {
                            echo "<option value=\"\">No hay órdenes de compra disponibles</option>";
                        }
                        ?>
                    </select>
                    <br><br>
                    <input type="hidden" name="accion" value="guardar_venta">
                    <button type="submit">Guardar venta</button>
                    <br><br>
                </form>
            </div>
            <!-- Formulario para crear nueva orden de venta -->
            <div class="boxSales2">
                <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" id="newOrderForm">
                    <label for="documento">Documento</label>
                    <input type="text" name="documento" id="documento" required>
                    <input type="hidden" name="accion" value="crear_orden"><br>
                    <button type="submit">Nueva orden de venta</button>
                </form>
            </div>
            <div class="boxSalesInventary">
                <button class="viewInventary"><a href="inventory.php">INVENTARIO</a></button>
            </div>
            <div class="boxSales3">
                <div class="order-list">
                    <h2>Órdenes de venta</h2>
                    <?php
                    require '../php/sales/salesOrders.php';
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
    </script>
</body>
</html>
