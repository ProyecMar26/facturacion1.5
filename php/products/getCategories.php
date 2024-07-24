<?php
function get_categories($conn) {
    $sql_categorias = "SELECT * FROM categoria";
    $resultado_categorias = $conn->query($sql_categorias);
    return $resultado_categorias;
}
?>
