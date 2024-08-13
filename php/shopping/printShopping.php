<?php
require "../conn.php";

// Inicializar variables
$fecha = date('Y-m-d'); // Fecha actual por defecto
$id_orden = 0;
$result = null;
$total_compra = 0;

// Consultar todas las órdenes para la fecha actual
$query_ordenes = "SELECT DISTINCT id_orden FROM compras WHERE fecha = ?";
$stmt_ordenes = $conn->prepare($query_ordenes);

if ($stmt_ordenes === false) {
    die('Error en la preparación de la consulta de órdenes: ' . $conn->error);
}

$stmt_ordenes->bind_param("s", $fecha);
$stmt_ordenes->execute();
$result_ordenes = $stmt_ordenes->get_result();
$ordenes = [];

while ($row = $result_ordenes->fetch_assoc()) {
    $ordenes[] = $row['id_orden'];
}

// Consultar compras si se ha seleccionado un ID de orden
if (isset($_GET['id_orden']) && !empty($_GET['id_orden'])) {
    $id_orden = intval($_GET['id_orden']);

    $query = "
        SELECT c.id_compras, c.id_orden, c.cantidad, c.precio_compra, (c.precio_compra * c.cantidad) AS total, p.nombre AS persona, p.empresa
        FROM compras c
        JOIN persona p ON c.id_persona = p.id_persona
        WHERE c.id_orden = ? AND c.fecha = ?
    ";
    $stmt = $conn->prepare($query);

    if ($stmt === false) {
        die('Error en la preparación de la consulta de compras: ' . $conn->error);
    }

    $stmt->bind_param("is", $id_orden, $fecha);
    $stmt->execute();
    $result = $stmt->get_result();

    // Calcular el total de la compra
    while ($row = $result->fetch_assoc()) {
        $total_compra += $row['total'];
    }

    // Volver al principio para recuperar los datos nuevamente
    $result->data_seek(0);
}
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="../../style/styles.css">
    <title>Imprimir Compras</title>
</head>
<body>
    <h1>Imprimir Compras</h1>

    <!-- Formulario para seleccionar la fecha y el ID de la orden -->
    <form method="get" action="printShopping.php" class="no-print">
        <div class="form-container">
            <label for="fecha">Fecha:</label>
            <input type="date" name="fecha" id="fecha" value="<?php echo htmlspecialchars($fecha); ?>" required>
            <label for="id_orden">ID Orden:</label>
            <select name="id_orden" id="id_orden" required>
                <option value="">Seleccione una orden</option>
                <?php foreach ($ordenes as $orden): ?>
                    <option value="<?php echo htmlspecialchars($orden); ?>" <?php echo ($id_orden == $orden) ? 'selected' : ''; ?>>
                        <?php echo htmlspecialchars($orden); ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <button type="submit">Generar Reporte</button>
        </div>
    </form>

    <?php if ($result): ?>
        <table class="tablePrint">
            <thead>
                <tr class="header-info">
                    <td colspan="7">
                        <p>ID Orden Compra: <?php echo htmlspecialchars($id_orden); ?> &nbsp;</p> 
                        <p id="fecha">Fecha: <?php echo htmlspecialchars($fecha); ?></p>
                        <h2>Supermercado La Dormilona</h2>
                    </td>
                </tr>
                <tr>
                    <th>ID Compras</th>
                    <th>ID Orden</th>
                    <th>Cantidad</th>
                    <th>Precio Compra</th>
                    <th>Total</th>
                    <th>Persona</th>
                    <th>Empresa</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['id_compras']); ?></td>
                        <td><?php echo htmlspecialchars($row['id_orden']); ?></td>
                        <td><?php echo htmlspecialchars($row['cantidad']); ?></td>
                        <td><?php echo number_format(htmlspecialchars($row['precio_compra']), 2); ?></td>
                        <td><?php echo number_format(htmlspecialchars($row['total']), 2); ?></td>
                        <td><?php echo htmlspecialchars($row['persona']); ?></td>
                        <td><?php echo htmlspecialchars($row['empresa']); ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="6" style="text-align: right;"><strong>Total:</strong></td>
                    <td><?php echo number_format($total_compra, 2); ?></td>
                </tr>
            </tfoot>
        </table>

        <div class="button-container no-print">
            <button onclick="window.print()">Imprimir</button>
            <button onclick="window.location.href='../../modules/shopping.php'">Volver a Compras</button>
        </div>
    <?php endif; ?>
</body>
</html>
