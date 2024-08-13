<?php
require "../php/conn.php";

require "../php/inventory/deleteInventory.php";

require "../php/inventory/countProducts.php";

require "../php/inventory/updateInventory.php";

require "../php/inventory/resultInventory.php";
// Cerrar la conexión a la base de datos
$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <?php include "../php/head.php" ?>
    <title>Inventario</title>

</head>
<body>
    <header>
        <?php include "../php/navbar.php" ?>
        <div class="boxInventory box">
            <h1 class="titleprinci">Inventario</h1>
            <?php
            // Establecer conexión a la base de datos
            $conn = new mysqli('localhost', 'root', '', 'sistema_facturacion');
            
            // Verificar si hay un error de conexión
            if ($conn->connect_error) {
                die("Error de conexión: " . $conn->connect_error);
            }
            // Consulta para obtener todos los registros de la tabla 'inventario'
            $sql_inventario_completo = "SELECT id_productos, nombre, cantidad FROM inventario";
            
            // Ejecutar la consulta SQL
            $resultado_inventario_completo = $conn->query($sql_inventario_completo);
            
            // Verificar si se obtuvieron resultados
            if ($resultado_inventario_completo && $resultado_inventario_completo->num_rows > 0) {
                // Mostrar la tabla de inventario
                echo "<table>";
                echo "<tr>
                        <th>ID Producto</th>
                        <th>Nombre</th>
                        <th>Cantidad</th>
                      </tr>";
                while ($fila = $resultado_inventario_completo->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $fila["id_productos"] . "</td>";
                    echo "<td>" . $fila["nombre"] . "</td>";
                    echo "<td>" . $fila["cantidad"] . "</td>";
                    echo "</tr>";
                }
                echo "</table>";
            } else {
                // Mostrar un mensaje si no hay productos en el inventario
                echo "No se encontraron productos en el inventario.";
            }
            ?>
        </div>
        <div class="boxInventory2 box">
            <form method="get" name="nombre"> <br>
                <label for="nombre">Nombre del Producto:</label>
                <input type="text" id="nombre" name="nombre">
                <button type="submit">Buscar</button><br><br>
            </form>
        
            <?php
            // Establecer conexión a la base de datos
            $conn = new mysqli('localhost', 'root', '', 'sistema_facturacion');
        
            // Verificar si hay un error de conexión
            if ($conn->connect_error) {
                die("Error de conexión: " . $conn->connect_error);
            }
        
            // Verificar si la solicitud HTTP es de tipo GET y si se recibió el parámetro "nombre" (para buscar         un producto)
        
            if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["nombre"])) {
                // Obtener el nombre del producto enviado por el formulario
                $nombre = $_GET['nombre'];
        
                // Crear la consulta SQL para buscar el producto en el inventario
                $sql = "SELECT id_productos, nombre, cantidad FROM inventario WHERE nombre = '$nombre'";
        
                // Ejecutar la consulta SQL
                $resultado = $conn->query($sql);
        
                // Verificar si se encontró el producto
                if ($resultado && $resultado->num_rows > 0) {
                    echo "<br>";
                    echo "<table class='tabla_general1'>";
                    echo "<tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Cantidad</th>
                        </tr>";
                    // Iterar sobre cada fila de resultados y mostrar los datos en la tabla
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
            <form method="post" name="analisis"> <br>
            <button type="submit" name="submit_analisis">Análisis de productos</button>
            <br><br>
            </form>

            <?php
            // Establecer conexión a la base de datos
            $conn = new mysqli('localhost', 'root', '', 'sistema_facturacion');
            
            // Verificar si hay un error de conexión
            if ($conn->connect_error) {
                die("Error de conexión: " . $conn->connect_error);
            }
            
            // Verificar si se envió el formulario de análisis de productos
            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit_analisis"])) {

            //tabla numero 1    
                echo "<h3 class='texto1'>Producto mas vendido</h3>";
                echo "<br>";
                echo "<table class ='tabla1'>";
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

            //tabla numero dos    
                echo "<h3 class='texto2'>Producto menos vendido</h3>";
                echo "<br>";
                echo "<table class ='tabla2'>";
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

            //la tabla 3
                echo "<h3 class='texto3'>Ventas</h3>";
                echo "<br>";
                echo "<table class ='tabla3'>";
                echo "<tr>
                        <th>Ventas Semanales</th>
                        <th>Ventas Mensuales</th>
                        <th>Ventas Anuales</th>
                    </tr>";
                echo "<tr>";
                // Promedio Semanal
                    echo "<td>";
                    if ($resultado_total_ventas_semanal && $resultado_total_ventas_semanal->num_rows > 0) {
                        $fila_semanal = $resultado_total_ventas_semanal->fetch_assoc();
                        echo $fila_semanal["total_semanal"];
                    } else {
                        echo "No disponible";
                    }
                    echo "</td>";
                // Promedio Mensual
                    echo "<td>";
                    if ($resultado_total_ventas_mensual && $resultado_total_ventas_mensual->num_rows > 0) {
                        $fila_mensual = $resultado_total_ventas_mensual->fetch_assoc();
                        echo $fila_mensual["total_mensual"];
                    } else {
                        echo "No disponible";
                    }
                    echo "</td>";
                // Promedio Anual
                    echo "<td>";
                    if ($resultado_total_ventas_anual && $resultado_total_ventas_anual->num_rows > 0) {
                        $fila_anual = $resultado_total_ventas_anual->fetch_assoc();
                        echo $fila_anual["total_anual"];
                    } else {
                        echo "No disponible";
                    }
                    echo "</td>";
                echo "</tr>";
                echo "</table><br>";

            //tabla 4
                echo "<h3 class='texto4'>Productos con poca cantidad</h3>";
                echo "<br>";
                echo "<table class ='tabla4'>";
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
            // Cerrar la conexión a la base de datos
            $conn->close();
            ?>

        </div>
    </header>
</body>
</html>