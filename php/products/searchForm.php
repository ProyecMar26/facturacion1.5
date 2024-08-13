<form method="post">
    <input type="text" name="buscar" value="<?php echo htmlspecialchars($search_query); ?>">
    <button type="submit">Buscar</button>
    <button type="submit" name="clear_search">Eliminar Búsqueda</button>
</form>
<div class="boxPrint">
    <a href="../php/products/printProducts.php"><button>Imprimir productos</button></a>
</div>
