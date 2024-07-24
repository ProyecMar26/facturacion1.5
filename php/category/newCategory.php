<?php
// Verificar si se envió el formulario para agregar una nueva categoría
if ($_SERVER["REQUEST_METHOD"] == "POST" && !isset($_POST['action'])) {
    // Obtener los datos del formulario
    $categoria = $_POST['categoria'];

    // Crear la consulta SQL para verificar si la categoría ya existe
    $sql_verificar_categoria = "SELECT * FROM categoria WHERE categoria = '$categoria'";
    $resultado_verificacion = $conn->query($sql_verificar_categoria);

    if ($resultado_verificacion && $resultado_verificacion->num_rows > 0) {
        // Si la categoría ya existe, mostrar un mensaje de error
        echo "<script>alert('Error: la categoría \"$categoria\" ya existe en la base de datos.');</script>";
    } else {
        // Crear la consulta SQL para insertar la nueva categoría en la base de datos
        $sql_insertar = "INSERT INTO categoria (categoria) VALUES ('$categoria')";

        // Ejecutar la consulta SQL para insertar la nueva categoría
        if ($conn->query($sql_insertar) === TRUE) {
           
        } else {
            echo "Error al guardar la categoría: " . $conn->error;
        }
    }
}
?>