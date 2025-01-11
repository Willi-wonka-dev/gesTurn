<?php 
$host = 'localhost';  
$dbname = 'gesturn';   
$user = 'root';       
$pass = '';     


function conectar() {
    global $host, $user, $pass, $dbname;
    return new mysqli($host, $user, $pass, $dbname);   
}


function login($usuario, $password, &$mensaje){ 
    $sql = "SELECT * FROM usuarios WHERE usuario = '$usuario'";
    $conexion = conectar();
    $consulta = $conexion->query($sql);
    if($consulta->num_rows == 1){  
        $fila = $consulta->fetch_assoc();
        if($password == $fila['password']){
            $_SESSION['sello'] = true;
            $_SESSION['usuario_id'] = $fila['id'];
            $_SESSION['es_admin'] = $fila['admin']; // Añade esta línea
            header('Location: inicio.php');
            exit;
        } else {
            $mensaje = "Los datos no son correctos.";
        }
    } else {
        if($consulta->num_rows > 1){
            echo "Estamos teniendo problemas técnicos. Vuelva en otro momento";
            exit;
        } else {
            $mensaje = "Los datos no son correctos.";            
        }
    }
}


?>