<?php
require_once('models/configuracion.php');

$mensaje = '';
$configuraciones = obtener_configuraciones();
$usuarios = obtener_usuarios();

$usuario_editar = null;
if (isset($_GET['editar'])) {
    $id_editar = $_GET['editar'];
    $usuario_editar = obtener_usuario_por_id($id_editar);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['accion'])) {
        switch ($_POST['accion']) {
            case 'guardar_config':
                guardar_configuraciones($_POST);
                $mensaje = "Configuraciones guardadas correctamente.";
                $configuraciones = obtener_configuraciones();
                break;
            case 'agregar_usuario':
                agregar_usuario($_POST);
                $mensaje = "Usuario agregado correctamente.";
                $usuarios = obtener_usuarios();
                break;
            case 'editar_usuario':
                editar_usuario($_POST);
                $mensaje = "Usuario editado correctamente.";
                $usuarios = obtener_usuarios();
                break;
            case 'eliminar_usuario':
                eliminar_usuario($_POST['id']);
                $mensaje = "Usuario eliminado correctamente.";
                $usuarios = obtener_usuarios();
                break;
        }
    }
}

require_once('views/configuracion.php');
?>