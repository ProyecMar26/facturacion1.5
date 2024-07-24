<?php
function clear_search() {
    if (isset($_POST['clear_search'])) {
        return '';
    }
    return isset($_POST['buscar']) ? $_POST['buscar'] : '';
}
?>
