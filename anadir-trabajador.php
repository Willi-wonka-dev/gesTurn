<?php 
session_start();
require_once ("includes/funciones.php");
comprobarSiHaIniciadoSesion();
require_once("models/trabajadores.php");


if($_SERVER['REQUEST_METHOD'] === 'POST'){
    if(isset($_POST['accion']) and $_POST['accion']=="Agregar"){      
        insertar_trabajador($_POST);
    }
}
?>

<!DOCTYPE html>
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
                include("includes/funciones.php"); 
                menu(); 
            ?>
       </header>
       <main>
            <h1>Trabajadores</h1>           
            
            <form id="trabajador-anadir" action="trabajadores.php" method="POST">
                    <label for="nombre">Nombre:</label>
                    <input type="text" name="nombre" required>
                    <input type="text" name="apellido1" required>
                    <input type="text" name="apellido2" required>
                    <label for="email">Email</label>
                    <input type="text" name="email">
                    <label for="telefono">Teléfono </label>
                    <input type="text" name="telefono">
                    <label for="ffechaNac">Fecha de Nacimiento"></label>
                    <input type="text" name="ffechaNac">
                    <label for="ffechaContrato">Fecha de Contrato</label>
                    <input type="text" name="ffechaContrato">
                    <label for="ffechafincontrato">Fecha de finalización de contrato:</label>
                    <input type="text" name="ffechafincontrato">
                    <label for="dni">Dni</label>
                    <input type="text" name="dni">
                    <label for="direccion">Dirección</label>
                    <textarea name="direccion"></textarea>

                    <input type="submit" value="Agregar" name="accion">
            </form>



       </main>
    </div>
</body>
</html>