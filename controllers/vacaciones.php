<?php
require_once('models/vacaciones.php');

$mensaje = '';
$trabajadores = obtener_trabajadores();
$vacaciones_mostrar = null;
$trabajador_seleccionado = null;

if (isset($_GET['id'])) {
    $trabajador_seleccionado = obtener_trabajador($_GET['id']);
    $vacaciones_mostrar = obtener_vacaciones($_GET['id']);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['accion'])) {
        switch ($_POST['accion']) {
            case 'solicitar':
                solicitar_vacaciones($_POST);
                $mensaje = "Vacaciones solicitadas correctamente.";
                break;
            case 'cambiar_estado':
                cambiar_estado_vacaciones($_POST['id'], $_POST['nuevo_estado']);
                $mensaje = "Estado de vacaciones actualizado.";
                break;
            case 'cancelar':
                cancelar_vacaciones($_POST['id']);
                $mensaje = "Vacaciones canceladas.";
                break;
        }
        if (isset($_GET['id'])) {
            $vacaciones_mostrar = obtener_vacaciones($_GET['id']);
        }
    }
}

require_once('views/vacaciones.php');
?>