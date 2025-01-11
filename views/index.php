<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GesTurn</title>
    <link rel="stylesheet" href="css/estilos.css">
    <script src="js/scripts.js"></script>
</head>
<body>
    
    <div id="contenedor">

        
        <form action="" method="POST" id="login">
            <h1>GesTurn &copy;</h1>
            <p>by David Amador</p>
            <label for="usuario">Usuario:</label>
            <input type="text" name="usuario" id="usuario">
            <label for="password">Password:</label>
            <input type="text" name="password" id="password">
            <?php if($mensaje!="") {echo $mensaje;} ?>
            <input type="submit" value="iniciar sesión">
        </form>
    </div>

</body>
</html>