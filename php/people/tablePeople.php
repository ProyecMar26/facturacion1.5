<?php
if ($resultado_personas && $resultado_personas->num_rows > 0) {
    echo "<h2>Personas</h2>";
    echo "<table>";
    echo "<tr>
        <th>ID persona</th>
        <th>Documento.</th>
        <th>Nombre completo</th>
        <th>Direccion</th>
        <th>Telefono</th>
        <th>Empresa</th>
        <th>Guardar</th>
        <th>Eliminar</th>
    </tr>";
    while ($fila = $resultado_personas->fetch_assoc()) {
    echo "<tr>
        <form method='post' action='../php/people/editPeople.php'>
            <td><input type='hidden' name='id_persona' value='{$fila['id_persona']}'>{$fila['id_persona']}</td>
            <td><input type='number' name='documento' value='{$fila['documento']}'></td>
            <td><input type='text' name='nombre' value='{$fila['nombre']}'></td>
            <td><input type='text' name='direccion' value='{$fila['direccion']}'></td>
            <td><input type='number' name='telefono' value='{$fila['telefono']}'></td>
            <td><input type='text' name='empresa' value='{$fila['empresa']}'></td>
            <td><button type='submit'>Guardar</button></td>
            <td><a href=\"?id={$fila['id_persona']}\" onclick=\"return confirm('¿Estás seguro que deseas eliminar esta persona?')\">Eliminar</a></td>
                            </form>
        </tr>";
        }
    echo "</table>";
    }
?>
