<?php 
session_start();
require_once("includes/funciones.php");

comprobarSiHaIniciadoSesion();

// Comprueba si el usuario es administrador
if (!isset($_SESSION['es_admin']) || $_SESSION['es_admin'] != 1) {
    header('Location: inicio.php');
    exit;
}

require_once('controllers/configuracion.php');
?>