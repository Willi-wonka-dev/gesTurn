<?php
if (!defined('BloqueoIncludes')) {
        echo "Acceso directo - No permitido";
        exit;
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
                menu(); 
            ?>
       </header>
       <main>
            <h1>Trabajadores</h1>           
            
            <form id="trabajador-anadir" action="trabajadores.php" method="POST">
                    <input type="hidden" name="id" value="<?php 
                            echo $persona['id'];
                            ?>">
                    <label for="nombre">Nombre:</label>
                    <input type="text" name="nombre" required 
                    value="<?php 
                            echo $persona['nombre'];
                            ?>">
                    <input type="text" name="apellido1" 
                    value="<?php 
                            echo $persona['apellido1'];
                            ?>" required>
                    <input type="text" name="apellido2"
                    value="<?php 
                            echo $persona['apellido2'];
                            ?>" required>
                    <label for="email">Email</label>
                    <input type="text" value="<?php 
                            echo $persona['email'];
                            ?>" name="email">
                    <label for="telefono">Teléfono </label>
                    <input type="text" value="<?php 
                            echo $persona['telefono'];
                            ?>" name="telefono">
                    <label for="ffechaNac">Fecha de Nacimiento"</label>
                    <input type="date"value="<?php 
                            echo $persona['fNacimiento'];
                            ?>" name="ffechaNac">
                    <label for="ffechaContrato">Fecha de Contrato</label>
                    <input type="date"value="<?php 
                            echo $persona['fContrato'];
                            ?>" name="ffechaContrato">
                    <label for="ffechafincontrato">Fecha de finalización de contrato:</label>
                    <input type="date" name="ffechafincontrato" value="<?php 
                            echo $persona['fFinContrato'];
                            ?>">
                    <label for="dni">Dni</label>
                    <input type="text" value="<?php 
                            echo $persona['dni'];
                            ?>" name="dni">
                    <label for="direccion">Dirección</label>
                    <textarea name="direccion"><?php echo $persona['direccion'];?></textarea>
                    <label for="foto">Foto:</label>
<input type="file" name="foto" accept="image/jpeg">
<?php if (file_exists(IMAGEN_CARPETA . $trabajador_editar['id'] . '.jpg')): ?>
    <img src="<?php echo IMAGEN_CARPETA . $trabajador_editar['id'] . '.jpg'; ?>" alt="Foto del trabajador" style="max-width: 100px;">
<?php endif; ?>
                    <input type="submit" value="Editar" name="accion">
            </form>
       </main>
    </div>
</body>
</html>