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
    $sql = "SELECT id, nombre, apellido1, apellido2 FROM personas ORDER BY nombre";
    $resultado = $conexion->query($sql);
    $trabajadores = [];
    while ($fila = $resultado->fetch_assoc()) {
        $trabajadores[] = $fila;
    }
    $conexion->close();
    return $trabajadores;
}

function obtener_nombre_mes($mes) {
    $nombres = [
        1 => 'Enero', 2 => 'Febrero', 3 => 'Marzo', 4 => 'Abril',
        5 => 'Mayo', 6 => 'Junio', 7 => 'Julio', 8 => 'Agosto',
        9 => 'Septiembre', 10 => 'Octubre', 11 => 'Noviembre', 12 => 'Diciembre'
    ];
    return $nombres[$mes];
}
?>