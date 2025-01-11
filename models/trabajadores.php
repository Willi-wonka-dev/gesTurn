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
    $sql = "SELECT * FROM personas";
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

function insertar_trabajador($datos) {
    $conexion = conectar();
    $sql = "INSERT INTO personas (nombre, apellido1, apellido2, email, telefono, fContrato, fFinContrato, dni, direccion, fNacimiento) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("ssssssssss", 
        $datos['nombre'], 
        $datos['apellido1'], 
        $datos['apellido2'], 
        $datos['email'], 
        $datos['telefono'], 
        $datos['fContrato'], 
        $datos['fFinContrato'], 
        $datos['dni'], 
        $datos['direccion'], 
        $datos['fNacimiento']
    );
    $stmt->execute();
    $id = $conexion->insert_id;
    $conexion->close();
    return $id;
}

function editar_trabajador($datos) {
    $conexion = conectar();
    $sql = "UPDATE personas SET 
            nombre = ?, apellido1 = ?, apellido2 = ?, email = ?, telefono = ?, 
            fContrato = ?, fFinContrato = ?, dni = ?, direccion = ?, fNacimiento = ? 
            WHERE id = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("ssssssssssi", 
        $datos['nombre'], 
        $datos['apellido1'], 
        $datos['apellido2'], 
        $datos['email'], 
        $datos['telefono'], 
        $datos['fContrato'], 
        $datos['fFinContrato'], 
        $datos['dni'], 
        $datos['direccion'], 
        $datos['fNacimiento'],
        $datos['id']
    );
    $result = $stmt->execute();
    $conexion->close();
    return $result;
}
function borrar_trabajador($id) {
    $conexion = conectar();
    $sql = "DELETE FROM personas WHERE id = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $conexion->close();
}
?>