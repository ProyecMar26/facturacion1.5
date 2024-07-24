<div class="boxInventory2">
    <form method="get" name="nombre">
        <br>
        <label for="nombre">Nombre del Producto:</label>
        <input type="text" id="nombre" name="nombre">
        <button type="submit">Buscar</button>
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["nombre"])) {
        $nombre = $_GET['nombre'];
        $conn = new mysqli('localhost', 'root', '', 'sistema_facturacion');
        if ($conn->connect_error) {
            die("Error de conexión: " . $conn->connect_error);
        }
        $sql = "SELECT id_productos, nombre, cantidad FROM inventario WHERE nombre = '$nombre'";
        $resultado = $conn->query($sql);
        if ($resultado && $resultado->num_rows > 0) {
            echo "<br>";
            echo "<table class='tabla_general1'>";
            echo "<tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Cantidad</th>
                  </tr>";
            while ($fila = $resultado->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $fila["id_productos"] . "</td>";
                echo "<td>" . $fila["nombre"] . "</td>";
                echo "<td>" . $fila["cantidad"] . "</td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "No se encontró ningún producto con el nombre \"$nombre\"";
        }
    }
    ?>
    <form method="post" name="analisis">
        <br>
        <button type="submit" name="submit_analisis">Análisis de productos</button>
        <br><br>
    </form>
</div>
