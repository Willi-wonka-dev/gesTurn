<?php
if (!defined('BloqueoIncludes')) {
    echo "Acceso directo - No permitido";
    exit;
}
?><!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gesturn</title>
    <link rel="stylesheet" href="css/estilos.css">
    <script src="js/scripts.js"></script>
</head>
<body>
    <div id="web">
       <header>
            <img src="images/logo-gesturn.png" alt="Gesturn - Gestión de turnos de empresa">
            <h1>Gesturn &copy;</h1>
            <?php 
                menu();
            ?>
       </header>
       <main>
            <h1>Bienvenido a Gesturn</h1>           
            <p>Selecciona la opción deseada del menú</p>
       </main>
    </div>
</body>
</html>