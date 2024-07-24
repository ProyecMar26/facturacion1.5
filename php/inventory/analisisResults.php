<div class="boxInventory3">
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit_analisis"])) {
        echo "<h3 class='texto1'>Producto más vendido</h3>";
        echo "<br>";
        echo "<table class='tabla1'>";
        echo "<tr>
                <th>Nombre Producto</th>
                <th>Total Ventas</th>
            </tr>";
        while ($fila = $resultado_mas_vendidos->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $fila["nombre_producto"] . "</td>";
            echo "<td>" . $fila["total_ventas"] . "</td>";
            echo "</tr>";
        }
        echo "</table><br>";

        echo "<h3 class='texto2'>Producto menos vendido</h3>";
        echo "<br>";
        echo "<table class='tabla2'>";
        echo "<tr>
                <th>Nombre Producto</th>
                <th>Total Ventas</th>
            </tr>";
        while ($fila = $resultado_menos_vendidos->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $fila["nombre_producto"] . "</td>";
            echo "<td>" . $fila["total_ventas"] . "</td>";
            echo "</tr>";
        }
        echo "</table><br>";

        echo "<h3 class='texto3'>Ventas Mensuales</h3>";
        echo "<br>";
        echo "<table class='tabla3'>";
        echo "<tr>
                <th>Total Ventas Mensuales</th>
            </tr>";
        while ($fila = $resultado_total_ventas_mensual->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $fila["total_mensual"] . "</td>";
            echo "</tr>";
        }
        echo "</table><br>";

        echo "<h3 class='texto4'>Ventas Semanales</h3>";
        echo "<br>";
        echo "<table class='tabla4'>";
        echo "<tr>
                <th>Total Ventas Semanales</th>
            </tr>";
        while ($fila = $resultado_total_ventas_semanal->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $fila["total_semanal"] . "</td>";
            echo "</tr>";
        }
        echo "</table><br>";

        echo "<h3 class='texto5'>Ventas Anuales</h3>";
        echo "<br>";
        echo "<table class='tabla5'>";
        echo "<tr>
                <th>Total Ventas Anuales</th>
            </tr>";
        while ($fila = $resultado_total_ventas_anual->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $fila["total_anual"] . "</td>";
            echo "</tr>";
        }
        echo "</table><br>";

        echo "<h3 class='texto6'>Productos con poca cantidad</h3>";
        echo "<br>";
        echo "<table class='tabla6'>";
        echo "<tr>
                <th>Nombre Producto</th>
                <th>Cantidad</th>
            </tr>";
        while ($fila = $resultado_productos_poca_cantidad->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $fila["nombre"] . "</td>";
            echo "<td>" . $fila["cantidad"] . "</td>";
            echo "</tr>";
        }
        echo "</table><br>";
    }
    ?>
</div>
