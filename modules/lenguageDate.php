<!DOCTYPE html>
<html>

<head>
   <?php
    include "../php/head.php"
    ?>
    <title>Fecha y hora </title>
</head>

<body>
    <header>
        <?php include '../php/navbar.php'; 
         include '../php/boxSetting.php'; ?>
        <div class="boxLenguageDate">
            <h2>Fecha e idioma</h2>
            <p>Fecha y hora</p>
            <form>
                <label for="hora">Hora:</label>
                <input type="time" id="hora" name="hora">
                <br><br>
                <label for="fecha">Fecha:</label>
                <input type="date" id="fecha" name="fecha">
                <br><br>
            </form>
            <p>Idioma</p>
            <form>
                <input type="radio" id="opcion1" name="opcion" value="opcion1">
                <label for="opcion1">Español</label><br><br>
                <input type="radio" id="opcion2" name="opcion" value="opcion2">
                <label for="opcion2">Ingles</label><br><br>
            </form>
            <button id="boton" class="save">Guardar</button>
        </div>
    </header>
</body>
</html>