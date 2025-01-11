<?php

global $host, $user, $pass, $dbname;
$host = 'localhost';
$dbname = 'gesturn';
$user = 'root';
$pass = '';

function conectar() {
    global $host, $user, $pass, $dbname;
    return new mysqli($host, $user, $pass, $dbname);
}

function obtener_usuario_por_id($id) {
    $conexion = conectar();
    $sql = "SELECT * FROM usuarios WHERE id = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $resultado = $stmt->get_result();
    $usuario = $resultado->fetch_assoc();
    $conexion->close();
    return $usuario;
}

function obtener_configuraciones() {
    $conexion = conectar();
    $sql = "SELECT * FROM configuraciones";
    $resultado = $conexion->query($sql);
    $configuraciones = [];
    while ($fila = $resultado->fetch_assoc()) {
        $configuraciones[$fila['clave']] = $fila['valor'];
    }
    $conexion->close();
    return $configuraciones;
}

function guardar_configuraciones($datos) {
    $conexion = conectar();
    foreach ($datos as $clave => $valor) {
        if ($clave != 'accion') {
            $sql = "INSERT INTO configuraciones (clave, valor) VALUES (?, ?) 
                    ON DUPLICATE KEY UPDATE valor = ?";
            $stmt = $conexion->prepare($sql);
            $stmt->bind_param("sss", $clave, $valor, $valor);
            $stmt->execute();
        }
    }
    $conexion->close();
}

function obtener_usuarios() {
    $conexion = conectar();
    $sql = "SELECT * FROM usuarios";
    $resultado = $conexion->query($sql);
    $usuarios = [];
    while ($fila = $resultado->fetch_assoc()) {
        $usuarios[] = $fila;
    }
    $conexion->close();
    return $usuarios;
}

function agregar_usuario($datos) {
    $conexion = conectar();
    $sql = "INSERT INTO usuarios (usuario, password, admin) VALUES (?, ?, ?)";
    $stmt = $conexion->prepare($sql);
    $admin = isset($datos['admin']) ? 1 : 0;
    $stmt->bind_param("ssi", $datos['usuario'], $datos['password'], $admin);
    $stmt->execute();
    $conexion->close();
}

function editar_usuario($datos) {
    $conexion = conectar();
    $sql = "UPDATE usuarios SET usuario = ?, password = ?, admin = ? WHERE id = ?";
    $stmt = $conexion->prepare($sql);
    $admin = isset($datos['admin']) ? 1 : 0;
    $stmt->bind_param("ssii", $datos['usuario'], $datos['password'], $admin, $datos['id']);
    $stmt->execute();
    $conexion->close();
}

function eliminar_usuario($id) {
    $conexion = conectar();
    $sql = "DELETE FROM usuarios WHERE id = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $conexion->close();
}
?>