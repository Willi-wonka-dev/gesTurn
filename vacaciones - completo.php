<?php 
session_start();
require_once("includes/funciones.php");

comprobarSiHaIniciadoSesion();

$host = 'localhost';  
$dbname = 'gesturn';   
$user = 'root';       
$pass = '';     

function conectar() {
    global $host, $user, $pass, $dbname;
    return new mysqli($host, $user, $pass, $dbname);
}

function mostrar_trabajadores() {
    $conexion = conectar();
    $sql = "SELECT * FROM personas";
    $consulta = $conexion->query($sql);
    if ($consulta->num_rows > 0) {  
        while ($contacto = $consulta->fetch_assoc()) {
            echo "<tr>";
                echo "<td>";
                    echo $contacto["nombre"];
                    echo " ";
                    echo $contacto["apellido1"];
                    echo " ";
                    echo $contacto["apellido2"];
                echo "</td>";
                echo "<td>";
                    echo "<a href='vacaciones.php?accion=ver&id=".$contacto['id']."'>Ver</a>";
                echo "</td>";
            echo "</tr>";
        }
    }
    else{
        echo "<tr><td>No hay trabajadores</td><td></td></tr>";
    }

}


function pedir_vacaciones($vacaciones) {
    global $mensaje;
    $conexion = conectar();
    $sql = "
    INSERT INTO `vacaciones` (`persona_id`, `fecha_inicio`, `fecha_fin`, `estado`) 
    VALUES (". $vacaciones['id'].", '". $vacaciones['f_ini']."', '". $vacaciones['f_fin']."', 'Solicitado')
    ";
    $consulta = $conexion->query($sql);
    if ($consulta === TRUE) {
        $mensaje = "Solicitud de vacaciones enviada";
    }
    else{
        echo "Error: " . $sql . "<br>" . $conexion->error;
    }
}
function mostrar_vacaciones($id) {
    $conexion = conectar();
    $sql = "select * from vacaciones where `persona_id` = ".$id;
    $consulta = $conexion->query($sql);
    if ($consulta->num_rows > 0) {
        while ($vacaciones = $consulta->fetch_assoc()) {
                    echo $vacaciones["fecha_inicio"];
                echo " - ";
                    echo $vacaciones["fecha_fin"];
                echo " (".$vacaciones["estado"].")";
                echo "<br>";
               
        }
    }
    else{
        echo "No hay resultados";
    }
}


$mostrar=false;
$mensaje = '';

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    if(isset($_POST['solicitar']) and $_POST['solicitar']=="Solicitar"){
        pedir_vacaciones($_POST);
    }
}


if(isset($_GET["accion"]) && $_GET["accion"] == "ver" && isset($_GET["id"])) {
    $id = $_GET["id"];
    $mostrar=true;
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
            <h1>Vacaciones</h1>           
            <style>
                thead{background-color: #ff9900; font-weight: bold;}
                thead td{color: white;}
                table, td{border: #ff9900 1px solid;}
                tr:hover{background-color:#ffe2b8;}
                #segunda{float:right; max-width: 30%;margin-right: 50px;}

            </style>
         <?php 
            if($mostrar){ 
                echo "<div id='segunda'>";
                echo "<h3>Vacaciones</h3>";
                    mostrar_vacaciones($id);
                echo "<br>";echo "<br>";
                if($mensaje != ''){echo $mensaje;}
                echo "<br>";echo "<br>";
                echo "
                <form action='vacaciones.php?accion=ver&id=".$id."' method='POST'>
                    <input type='hidden' id='id' name='id' value='".$id."'><br>
                    <label for='f_ini'>Fecha de Inicio:</label>
                    <input type='date' id='f_ini' name='f_ini'>
                    <label for='f_fin'>Fecha de Fin:</label>
                    <input type='date' id='f_fin' name='f_fin'>
                    <button type='submit' value='Solicitar' id='solicitar' name='solicitar'>Solicitar</button>
                </form>
                ";
                echo "</div>";
            }
        ?>


        <div id="primera">
            <table cellpadding="10px" cellspacing="0">
                <thead>
                <tr>
                    <td width="350px">Nombre</td>
                    <td>Acciones</td>
                </tr>
                </thead>
                
                <?php 
                mostrar_trabajadores()
                ?>
               

           </table>
        </div>

       
                
       </main>
    </div>
</body>
</html>



<?php
/*
$desde = date_create('2009-10-11');
$hasta = date_create('2009-10-13');
$dias = date_diff($desde, $hasta);
echo $dias->format('%R%a days');*/
?>