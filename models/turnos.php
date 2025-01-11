<?php

$host = 'localhost';  
$dbname = 'gesturn';   
$user = 'root';       
$pass = '';     

function conectar() {
    global $host, $user, $pass, $dbname;
    return new mysqli($host, $user, $pass, $dbname);
}

function obtener_turnos() {
    $conexion = conectar();
    $sql = "SELECT * FROM turnos";
    $resultado = $conexion->query($sql);
    $turnos = [];
    while ($fila = $resultado->fetch_assoc()) {
        $turnos[] = $fila;
    }
    $conexion->close();
    return $turnos;
}

function obtener_turno($id) {
    $conexion = conectar();
    $sql = "SELECT * FROM turnos WHERE id = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $resultado = $stmt->get_result();
    $turno = $resultado->fetch_assoc();
    $conexion->close();
    return $turno;
}





function borrar_turno($id) {
    $conexion = conectar();
    $sql = "DELETE FROM turnos WHERE id = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $conexion->close();
}

function obtener_grupos() {
    $conexion = conectar();
    $sql = "SELECT * FROM grupos_turnos";
    $resultado = $conexion->query($sql);
    $grupos = [];
    while ($fila = $resultado->fetch_assoc()) {
        $grupos[] = $fila;
    }
    $conexion->close();
    return $grupos;
}

function obtener_grupo($id) {
    $conexion = conectar();
    $sql = "SELECT * FROM grupos_turnos WHERE id = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $resultado = $stmt->get_result();
    $grupo = $resultado->fetch_assoc();
    $conexion->close();
    return $grupo;
}

function insertar_grupo($grupo) {
    $conexion = conectar();
    $sql = "INSERT INTO grupos_turnos (nombre, tipo, descripcion) VALUES (?, ?, ?)";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("sss", $grupo['nombre'], $grupo['tipo'], $grupo['descripcion']);
    $stmt->execute();
    $conexion->close();
}

// Modificar la función insertar_turno existente
function insertar_turno($turno) {
    $conexion = conectar();
    $sql = "INSERT INTO turnos (nombre, inicio, fin, personas_requeridas, horas, grupo_id) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("sssiii", 
        $turno['nombre'], 
        $turno['inicio'], 
        $turno['fin'], 
        $turno['personas_requeridas'], 
        $turno['horas'],
        $turno['grupo_id']
    );
    $stmt->execute();
    $conexion->close();
}

// Modificar la función editar_turno existente
function editar_turno($turno) {
    $conexion = conectar();
    $sql = "UPDATE turnos SET nombre = ?, inicio = ?, fin = ?, personas_requeridas = ?, horas = ?, grupo_id = ? WHERE id = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("sssiiii", 
        $turno['nombre'], 
        $turno['inicio'], 
        $turno['fin'], 
        $turno['personas_requeridas'], 
        $turno['horas'],
        $turno['grupo_id'],
        $turno['id']
    );
    $stmt->execute();
    $conexion->close();
}
function editar_grupo($grupo) {
    $conexion = conectar();
    $sql = "UPDATE grupos_turnos SET nombre = ?, tipo = ?, descripcion = ? WHERE id = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("sssi", 
        $grupo['nombre'], 
        $grupo['tipo'], 
        $grupo['descripcion'],
        $grupo['id']
    );
    $stmt->execute();
    $conexion->close();
}

function borrar_grupo($id) {
    $conexion = conectar();
    $sql = "DELETE FROM grupos_turnos WHERE id = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $conexion->close();
}

function hay_turnos_en_grupo($grupo_id) {
    $conexion = conectar();
    $sql = "SELECT COUNT(*) as total FROM turnos WHERE grupo_id = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("i", $grupo_id);
    $stmt->execute();
    $resultado = $stmt->get_result();
    $data = $resultado->fetch_assoc();
    $conexion->close();
    return $data['total'] > 0;
}

?>