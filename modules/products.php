<?php
require "../php/conn.php";
require "../php/products/addProducts.php";
require "../php/products/deleteProducts.php";
require "../php/products/clearSearch.php";
require "../php/products/getCategories.php";
require "../php/products/getProducts.php";

// Inicializar la variable $search_query
$search_query = isset($_POST['buscar']) ? $_POST['buscar'] : '';
$search_query = isset($_POST['clear_search']) ? '' : $search_query;

// Manejar la eliminación de productos
delete_product($conn);

// Obtener categorías
$categories = get_categories($conn);

// Obtener productos
$products = get_products($conn, $search_query);
?>
<!DOCTYPE html>
<html>
<head>
    <?php
    include "../php/head.php";
    ?>
    <title>Productos</title>
</head>
<body>
    <header>
        <?php include '../php/navbar.php'; ?>
        <main>
            <div class="boxProducts">
                <h1>Productos</h1>
                <?php include "../php/products/addProductForm.php"; ?>
            </div>
            <div class="boxProducts2">
                <form class="tabla_compras">
                    <h2>Productos</h2>
                    <?php include "../php/products/productsTable.php"; ?>
                </form>
            </div>
            <div class="boxProducts3">
                <h2>Buscar Productos</h2>
                <?php include "../php/products/searchForm.php"; ?>
            </div>
        </main>
    </header>
</body>
</html>
