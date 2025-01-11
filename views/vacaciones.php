<?php
if (!defined('BloqueoIncludes')) {
    echo "Acceso directo - No permitido";
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Vacaciones - Gesturn</title>
    <link rel="stylesheet" href="css/estilos.css">
    <script src="js/scripts.js"></script>
</head>
<body>
    <div id="web">
        <header>
            <img src="images/logo-gesturn.png" alt="Gesturn - Gestión de turnos de empresa">
            <h1>Gesturn &copy;</h1>
            <?php menu(); ?>
        </header>
        <main>
            <h1>Gestión de Vacaciones</h1>
            
            <?php if($mensaje != '') { echo "<p>$mensaje</p>"; } ?>

            <div class="contenedor-vacaciones">
                <div class="listado-personas">
                    <h2>Listado de Personas</h2>
                    <input type="text" id="buscar-persona" placeholder="Buscar persona...">
                    <ul>
                        <?php foreach ($trabajadores as $trabajador): ?>
                            <li>
                                <a href="?id=<?php echo $trabajador['id']; ?>">
                                    <?php echo $trabajador['nombre'] . ' ' . $trabajador['apellido1'] . ' ' . $trabajador['apellido2']; ?>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>

                <?php if ($trabajador_seleccionado): ?>
                    <div class="info-vacaciones">
                        <h2>Vacaciones de <?php echo $trabajador_seleccionado['nombre'] . ' ' . $trabajador_seleccionado['apellido1']; ?></h2>
                        <p>Días de vacaciones restantes: <?php echo calcular_dias_vacaciones_restantes($trabajador_seleccionado['id']); ?></p>
                        
                        <h3>Vacaciones Solicitadas</h3>
                        <table>
                            <thead>
                                <tr>
                                    <th>Fecha Inicio</th>
                                    <th>Fecha Fin</th>
                                    <th>Estado</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($vacaciones_mostrar as $vacacion): ?>
                                    <tr>
                                        <td><?php echo $vacacion['fecha_inicio']; ?></td>
                                        <td><?php echo $vacacion['fecha_fin']; ?></td>
                                        <td><?php echo $vacacion['estado']; ?></td>
                                        <td>
                                        <?php if (strtotime($vacacion['fecha_inicio']) > strtotime(date('Y-m-d'))): ?>
                                            <button onclick="mostrarPopup(<?php echo $vacacion['id']; ?>)">Cambiar Estado</button>
                                                <form action="" method="POST" style="display:inline;">
                                                    <input type="hidden" name="accion" value="cancelar">
                                                    <input type="hidden" name="id" value="<?php echo $vacacion['id']; ?>">
                                                    <button type="submit">Cancelar</button>
                                                </form>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>

                        <h3>Solicitar Nuevas Vacaciones</h3>
                        <form action="" method="POST">
                            <input type="hidden" name="accion" value="solicitar">
                            <input type="hidden" name="id" value="<?php echo $trabajador_seleccionado['id']; ?>">
                            <label for="fecha_inicio">Fecha de Inicio:</label>
                            <input type="date" id="fecha_inicio" name="fecha_inicio" required>
                            <label for="fecha_fin">Fecha de Fin:</label>
                            <input type="date" id="fecha_fin" name="fecha_fin" required>
                            <button type="submit">Solicitar Vacaciones</button>
                        </form>
                    </div>
                <?php endif; ?>
            </div>

            <div id="popup" class="popup" style="display:none;">
                <div class="popup-content">
                    <h3>Cambiar Estado de Vacaciones</h3>
                    <form id="cambiar-estado-form" action="" method="POST">
                        <input type="hidden" name="accion" value="cambiar_estado">
                        <input type="hidden" id="vacacion-id" name="id" value="">
                        <label for="nuevo-estado">Nuevo Estado:</label>
                        <select id="nuevo-estado" name="nuevo_estado">
                            <option value="aprobado">Aprobado</option>
                            <option value="rechazado">Rechazado</option>
                        </select>
                        <button type="submit">Guardar</button>
                        <button type="button" onclick="cerrarPopup()">Cancelar</button>
                    </form>
                </div>
            </div>
        </main>
    </div>

    <script>
    function mostrarPopup(id) {
        document.getElementById('popup').style.display = 'block';
        document.getElementById('vacacion-id').value = id;
    }

    function cerrarPopup() {
        document.getElementById('popup').style.display = 'none';
    }

    document.getElementById('buscar-persona').addEventListener('input', function(e) {
        var filter = e.target.value.toLowerCase();
        var li = document.querySelectorAll('.listado-personas li');
        
        for (var i = 0; i < li.length; i++) {
            var a = li[i].getElementsByTagName("a")[0];
            if (a.innerHTML.toLowerCase().indexOf(filter) > -1) {
                li[i].style.display = "";
            } else {
                li[i].style.display = "none";
            }
        }
    });
    </script>
</body>
</html>