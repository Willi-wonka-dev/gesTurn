<?php
require_once('models/festivos.php');

$mensaje = '';
$festivos = obtener_festivos();
$festivo_editar = null;

if (isset($_GET['accion'])) {
    switch ($_GET['accion']) {
        case 'editar':
            if (isset($_GET['id'])) {
                $festivo_editar = obtener_festivo($_GET['id']);
            }
            break;
        case 'eliminar':
            if (isset($_GET['id'])) {
                eliminar_festivo($_GET['id']);
                $mensaje = "Día festivo eliminado correctamente.";
                $festivos = obtener_festivos();
            }
            break;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['accion'])) {
        switch ($_POST['accion']) {
            case 'agregar':
                agregar_festivo($_POST);
                $mensaje = "Día festivo agregado correctamente.";
                break;
            case 'editar':
                editar_festivo($_POST);
                $mensaje = "Día festivo actualizado correctamente.";
                break;
        }
        $festivos = obtener_festivos();
    }
}

require_once('views/festivos.php');
?>