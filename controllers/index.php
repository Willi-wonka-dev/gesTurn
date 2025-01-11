<?php 
require_once('models/index.php');

$mensaje = '';

if($_SERVER['REQUEST_METHOD'] === 'POST'){

    $usuario = htmlspecialchars(trim($_POST['usuario']), ENT_QUOTES);

    $password = htmlspecialchars(trim($_POST['password']), ENT_QUOTES);

    login($usuario, $password, $mensaje);

}

include_once('views/index.php');


?>