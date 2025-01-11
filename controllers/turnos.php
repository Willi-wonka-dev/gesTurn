<?php
require_once('models/turnos.php');

$mensaje = '';
$turnos = obtener_turnos();
$grupos = obtener_grupos();
$turno_editar = null;
$grupo_editar = null;

if (isset($_GET['accion'])) {
    switch ($_GET['accion']) {
        case 'editar':
            if (isset($_GET['id'])) {
                $turno_editar = obtener_turno($_GET['id']);
            }
            break;
        case 'editar_grupo':
            if (isset($_GET['id'])) {
                $grupo_editar = obtener_grupo($_GET['id']);
            }
            break;
        case 'borrar':
            if (isset($_GET['id'])) {
                borrar_turno($_GET['id']);
                $mensaje = "Turno eliminado correctamente.";
                $turnos = obtener_turnos();
            }
            break;
        case 'borrar_grupo':
            if (isset($_GET['id'])) {
                // Verificar si hay turnos asociados
                if(!hay_turnos_en_grupo($_GET['id'])) {
                    borrar_grupo($_GET['id']);
                    $mensaje = "Grupo eliminado correctamente.";
                } else {
                    $mensaje = "No se puede eliminar el grupo porque tiene turnos asociados.";
                }
                $grupos = obtener_grupos();
            }
            break;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['accion'])) {
        switch ($_POST['accion']) {
            case 'Añadir':
                insertar_turno($_POST);
                $mensaje = "Turno añadido correctamente.";
                $turnos = obtener_turnos();
                break;
            case 'Editar':
                editar_turno($_POST);
                $mensaje = "Turno editado correctamente.";
                $turnos = obtener_turnos();
                break;
            case 'AñadirGrupo':
                insertar_grupo($_POST);
                $mensaje = "Grupo añadido correctamente.";
                $grupos = obtener_grupos();
                break;
            case 'EditarGrupo':
                editar_grupo($_POST);
                $mensaje = "Grupo editado correctamente.";
                $grupos = obtener_grupos();
                break;
        }
    }
}

// Obtener información adicional para mostrar el nombre del grupo en la lista de turnos
foreach ($turnos as &$turno) {
    if (!empty($turno['grupo_id'])) {
        $grupo = obtener_grupo($turno['grupo_id']);
        $turno['nombre_grupo'] = $grupo ? $grupo['nombre'] : '';
        $turno['tipo_grupo'] = $grupo ? $grupo['tipo'] : '';
    } else {
        $turno['nombre_grupo'] = '';
        $turno['tipo_grupo'] = '';
    }
}
unset($turno);

require_once('views/turnos.php');
?>