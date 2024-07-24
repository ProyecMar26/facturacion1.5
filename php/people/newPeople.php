<?php
require '../php/conn.php'; // Asegúrate de que esta es la ruta correcta

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

    // Verificar si el documento ya existe
    $sql_verificar_nombre = "SELECT * FROM persona WHERE documento = ?";
    $stmt_verificar = $conn->prepare($sql_verificar_nombre);
    $stmt_verificar->bind_param('s', $documento);
    $stmt_verificar->execute();
    $resultado_verificacion = $stmt_verificar->get_result();

    if ($resultado_verificacion->num_rows > 0) {
        // Redirigir a la página de people con un mensaje de error
        header("Location: ../../modules/people.php?error=exists");
        exit();
    } else {
        // Crear la consulta SQL para insertar la nueva persona
        $sql_insertar = "INSERT INTO persona (documento, nombre, direccion, telefono, empresa) VALUES (?, ?, ?, ?, ?)";
        $stmt_insertar = $conn->prepare($sql_insertar);
        $stmt_insertar->bind_param('dssds', $documento, $nombre, $direccion, $telefono, $empresa);

        if ($stmt_insertar->execute()) {
            // Redirigir a la página de people con un mensaje de éxito
            header("Location: ../../modules/people.php?success=added");
            exit();
        } else {
            // Redirigir a la página de people con un mensaje de error en la inserción
            header("Location: ../../modules/people.php?error=insert");
            exit();
        }
    }

    // Cerrar las declaraciones
    $stmt_verificar->close();
    $stmt_insertar->close();
}

?>
