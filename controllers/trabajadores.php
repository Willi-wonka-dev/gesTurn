<?php
require_once('models/trabajadores.php');
define('IMAGEN_CARPETA', 'images/trabajadores/');

$mensaje = '';
$trabajadores = obtener_trabajadores();
$trabajador_editar = null;

if (isset($_GET['accion'])) {
    switch ($_GET['accion']) {
        case 'ver':
            if (isset($_GET['id'])) {
                $trabajador_editar = obtener_trabajador($_GET['id']);
            }
            break;
        case 'borrar':
            if (isset($_GET['id'])) {
                borrar_trabajador($_GET['id']);
                $mensaje = "Trabajador eliminado correctamente.";
                $trabajadores = obtener_trabajadores();
            }
            break;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['accion'])) {
        switch ($_POST['accion']) {
            case 'Agregar':
                $id = insertar_trabajador($_POST);
                if ($id && manejar_subida_imagen($id)) {
                    $mensaje = "Trabajador agregado correctamente.";
                } else {
                    $mensaje = "Error al agregar el trabajador o subir la imagen.";
                }
                $trabajadores = obtener_trabajadores();
                break;
                case 'Editar':
                    $edicion_exitosa = editar_trabajador($_POST);
                    $subida_imagen_exitosa = manejar_subida_imagen($_POST['id']);
                    
                    if ($edicion_exitosa && $subida_imagen_exitosa) {
                        $mensaje = "Trabajador editado correctamente.";
                    } else {
                        $mensaje = "Error al editar el trabajador o subir la imagen. ";
                        if (!$edicion_exitosa) {
                            $mensaje .= "No se pudo actualizar la información del trabajador. ";
                        }
                        if (!$subida_imagen_exitosa) {
                            $mensaje .= "No se pudo subir la imagen. ";
                        }
                    }
                    $trabajadores = obtener_trabajadores();
                    break;
        }
    }
}
function manejar_subida_imagen($id) {
    if (isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {
        $nombre_archivo = $id . '.jpg';
        $ruta_destino = IMAGEN_CARPETA . $nombre_archivo;
        
        // Crear el directorio si no existe
        if (!file_exists(IMAGEN_CARPETA)) {
            if (!mkdir(IMAGEN_CARPETA, 0777, true)) {
                error_log("No se pudo crear el directorio " . IMAGEN_CARPETA);
                return false;
            }
        }

        // Mover el archivo subido
        if (move_uploaded_file($_FILES['foto']['tmp_name'], $ruta_destino)) {
            return true;
        } else {
            error_log("No se pudo mover el archivo subido a " . $ruta_destino);
            return false;
        }
    } else if (isset($_FILES['foto'])) {
        error_log("Error en la subida de archivo: " . $_FILES['foto']['error']);
    } else {
        error_log("No se recibió ningún archivo");
    }
    return false;
}
require_once('views/trabajadores.php');
?>