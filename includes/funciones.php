<?php 
function comprobarSiHaIniciadoSesion(){
		if (!isset($_SESSION['sello']) || $_SESSION['sello'] != true) {
			header('Location: index.php');
			exit;
		}
        define('BloqueoIncludes', true);
}
	


function menu(){
    echo "
            <ul>
                <li><a href='inicio.php'>Inicio</a></li>
                <li><a href='trabajadores.php'>Trabajadores</a></li>
                <li><a href='turnos.php'>Turnos</a></li>
                <li><a href='festivos.php'>Festivos</a></li>
                <li><a href='vacaciones.php'>Vacaciones</a></li>
                <li><a href='gestion.php'>Gestión de turnos</a></li>
                <li><a href='configuracion.php'>Configuración</a></li>
                <li><a href='salir.php'>Salir</a></li>
            </ul>   
    ";
}


?>