<?php
require "../conn.php";

// Consulta para obtener todos los datos de la tabla persona
$sql_persona = "SELECT * FROM categoria";
$result = $conn->query($sql_persona);

if (!$result) {
    die("Error al mostrar las categorias: " . $conn->error);
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Imprimir Categorias</title>
    <link rel="stylesheet" type="text/css" href="../../style/styles.css">
</head>
<body>
    <h1>Lista de Categorias</h1>
    
    <table class="tablePrint">
        <thead>
            <tr>
                <?php
                // Mostrar los encabezados de columna basados en los nombres de las columnas de la tabla persona
                $field_info = $result->fetch_fields();
                foreach ($field_info as $field) {
                    echo "<th>" . htmlspecialchars($field->name) . "</th>";
                }
                ?>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <?php foreach ($row as $value): ?>
                        <td><?php echo htmlspecialchars($value); ?></td>
                    <?php endforeach; ?>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
    
    <!-- Botón de impresión -->
    <div class="no-print">
        <button onclick="window.print()">Imprimir</button>
        <button onclick="window.location.href='../../modules/category.php'">Volver a Categorias</button>
    </div>
</body>
</html>
