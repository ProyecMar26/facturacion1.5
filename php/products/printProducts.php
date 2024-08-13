<?php
function get_products($conn, $search_query) {
    $search_query = $conn->real_escape_string($search_query);
    if ($search_query === '') {
        $sql_productos = "SELECT * FROM producto ORDER BY id_categoria, id_productos";
    } else {
        $sql_productos = "SELECT * FROM producto WHERE nombre LIKE '%$search_query%' ORDER BY id_categoria, id_productos";
    }
    $resultado_productos = $conn->query($sql_productos);

    if (!$resultado_productos) {
        die("Error en la consulta: " . $conn->error);
    }

    return $resultado_productos;
}

?>
