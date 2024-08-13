<?php
// Consulta para borrar todos los registros existentes en la tabla 'inventario'
$sql_borrar_inventario = "DELETE FROM inventario";

// Ejecutar la consulta SQL para borrar los registros existentes
if ($conn->query($sql_borrar_inventario) === TRUE) {
    
} else {
    
}
?>