<!DOCTYPE html>
<html>

<head>
   <?php include "../php/head.php"; ?>
   <title>Configuración de Idioma</title>
   <script src="../script/language.js" defer></script>
   <link rel="stylesheet" href="../css/styles.css">
</head>

<body>
    <header>
        <?php 
        include '../php/navbar.php'; 
        include '../php/boxSetting.php'; 
        ?>
        <div class="boxLenguageDate setting box">
            <h2>Idioma</h2>
            <p>Selecciona el idioma</p>
            <form id="languageForm">
                <input type="radio" id="espanol" name="language" value="es" checked>
                <label for="espanol">Español</label><br><br>
                <input type="radio" id="ingles" name="language" value="en">
                <label for="ingles">Inglés</label><br><br>
            </form>
            <button id="boton" class="save" onclick="changeLanguage()">Guardar</button>
        </div>
    </header>
</body>
</html>
