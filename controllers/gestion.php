<?php
require_once('models/gestion.php');

$mensaje = '';
$trabajadores = obtener_trabajadores();
$mes_actual = date('n');
$anio_actual = date('Y');
$primer_dia = date('N', strtotime("$anio_actual-$mes_actual-01"));
$dias_mes = cal_days_in_month(CAL_GREGORIAN, $mes_actual, $anio_actual);

require_once('views/gestion.php');
?>