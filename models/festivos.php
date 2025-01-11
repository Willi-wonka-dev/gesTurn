<?php

$host = 'localhost';  
$dbname = 'gesturn';   
$user = 'root';       
$pass = '';     

function conectar() {
    global $host, $user, $pass, $dbname;
    return new mysqli($host, $user, $pass, $dbname);
}

function obtener_festivos() {
    $conexion = conectar();
    $sql = "SELECT * FROM festivos ORDER BY fecha";
    $resultado = $conexion->query($sql);
    $festivos = [];
    while ($fila = $resultado->fetch_assoc()) {
        $festivos[] = $fila;
    }
    $conexion->close();
    return $festivos;
}

function obtener_festivo($id) {
    $conexion = conectar();
    $sql = "SELECT * FROM festivos WHERE id = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $resultado = $stmt->get_result();
    $festivo = $resultado->fetch_assoc();
    $conexion->close();
    return $festivo;
}

function agregar_festivo($datos) {
    $conexion = conectar();
    $sql = "INSERT INTO festivos (fecha, descripcion) VALUES (?, ?)";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("ss", $datos['fecha'], $datos['descripcion']);
    $stmt->execute();
    $conexion->close();
}

function editar_festivo($datos) {
    $conexion = conectar();
    $sql = "UPDATE festivos SET fecha = ?, descripcion = ? WHERE id = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("ssi", $datos['fecha'], $datos['descripcion'], $datos['id']);
    $stmt->execute();
    $conexion->close();
}

function eliminar_festivo($id) {
    $conexion = conectar();
    $sql = "DELETE FROM festivos WHERE id = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $conexion->close();
}
?>