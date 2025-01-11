<?php 

$host = 'localhost';  
$dbname = 'gesturn';   
$user = 'root';       
$pass = '';     

function conectar() {
    global $host, $user, $pass, $dbname;
    return new mysqli($host, $user, $pass, $dbname);
}

function obtener_trabajadores() {
    $conexion = conectar();
    $sql = "SELECT id, nombre, apellido1, apellido2 FROM personas";
    $resultado = $conexion->query($sql);
    $trabajadores = [];
    while ($fila = $resultado->fetch_assoc()) {
        $trabajadores[] = $fila;
    }
    $conexion->close();
    return $trabajadores;
}

function obtener_trabajador($id) {
    $conexion = conectar();
    $sql = "SELECT * FROM personas WHERE id = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $resultado = $stmt->get_result();
    $trabajador = $resultado->fetch_assoc();
    $conexion->close();
    return $trabajador;
}

function obtener_vacaciones($id_trabajador) {
    $conexion = conectar();
    $sql = "SELECT * FROM vacaciones WHERE persona_id = ? ORDER BY fecha_inicio DESC";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("i", $id_trabajador);
    $stmt->execute();
    $resultado = $stmt->get_result();
    $vacaciones = [];
    while ($fila = $resultado->fetch_assoc()) {
        $vacaciones[] = $fila;
    }
    $conexion->close();
    return $vacaciones;
}

function solicitar_vacaciones($datos) {
    $conexion = conectar();
    $sql = "INSERT INTO vacaciones (persona_id, fecha_inicio, fecha_fin, estado) VALUES (?, ?, ?, 'solicitado')";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("iss", $datos['id'], $datos['fecha_inicio'], $datos['fecha_fin']);
    $stmt->execute();
    $conexion->close();
}

function cambiar_estado_vacaciones($id, $nuevo_estado) {
    $conexion = conectar();
    $sql = "UPDATE vacaciones SET estado = ? WHERE id = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("si", $nuevo_estado, $id);
    $stmt->execute();
    $conexion->close();
}

function cancelar_vacaciones($id) {
    $conexion = conectar();
    $sql = "DELETE FROM vacaciones WHERE id = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $conexion->close();
}

function calcular_dias_vacaciones_restantes($id_trabajador) {
    $conexion = conectar();
    $sql = "SELECT SUM(DATEDIFF(fecha_fin, fecha_inicio) + 1) as dias_usados 
            FROM vacaciones 
            WHERE persona_id = ? AND (estado = 'aprobado' OR estado = 'solicitado')";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("i", $id_trabajador);
    $stmt->execute();
    $resultado = $stmt->get_result();
    $dias_usados = $resultado->fetch_assoc()['dias_usados'] ?? 0;
    $conexion->close();
    
    // Asumimos que cada trabajador tiene 30 días de vacaciones por año
    return 30 - $dias_usados;
}
?>