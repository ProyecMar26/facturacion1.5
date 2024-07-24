<?php
function get_products($conn, $search_query) {
    if ($search_query === '') {
        $sql_productos = "SELECT * FROM producto ORDER BY id_categoria, id_productos";
    } else {
        $sql_productos = "SELECT * FROM producto WHERE nombre LIKE '%$search_query%' ORDER BY id_categoria, id_productos";
    }
    $resultado_productos = $conn->query($sql_productos);
    return $resultado_productos;
}
?>
