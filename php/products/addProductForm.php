<!-- addProductForm.php -->
<form method="post">  
    <label for="nombre">Producto</label><br>
    <input type="text" name="nombre" class="form" required><br>
    <label for="precio_compra">Precio compra</label><br>
    <input type="number" name="precio_compra" class="form" required><br>
    <label for="categoria">Categoría</label><br>
    <select name="categoria" required>
    <?php
    foreach ($categories as $categoria) {
        echo "<option value=\"" . htmlspecialchars($categoria["categoria"]) . "\">" . htmlspecialchars($categoria["categoria"]) . "</option>";
    }
    ?>
    </select><br><br>
    <button type="submit">Guardar Producto</button><br><br>
</form>
