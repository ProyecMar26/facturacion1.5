<?php
require __DIR__ . '/../../php/conn.php'; // Conexión a la base de datos 

// Inicializar la variable $resultado_personas
$resultado_personas = null;

// Verificar si se envió el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $nombre = $_POST['nombre'];
    $direccion = $_POST['direccion'];
    $telefono = $_POST['telefono'];
    $empresa = $_POST['empresa'];
    $documento = $_POST['documento'];

    $sql_verificar_nombre = "SELECT * FROM persona WHERE documento = '$documento'";
    $resultado_verificacion = $conn->query($sql_verificar_nombre);

    if ($resultado_verificacion && $resultado_verificacion->num_rows > 0) {
        // Si el producto ya existe, mostrar un mensaje de error
        echo "<script>alert('Error: el producto \"$documento\" ya existe en la base de datos.');</script>";
    } else {
        // Crear la consulta SQL para insertar la persona en la base de datos
        $sql_insertar = "INSERT INTO persona (documento, nombre, direccion, telefono, empresa) VALUES ('$documento', '$nombre', '$direccion', '$telefono', '$empresa')";

        // Ejecutar la consulta SQL para insertar la persona
        if ($conn->query($sql_insertar) === TRUE) {
            // Redirigir a people.php después de la inserción
            header("Location: ../../modules/people.php");
            exit(); // Asegurarse de que el script se detenga después de la redirección
        } else {
            echo "Error al guardar la persona: " . $conn->error;
        }
    }   
}
?>
