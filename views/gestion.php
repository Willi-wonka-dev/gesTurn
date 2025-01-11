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
    <title>Gestión de Turnos - Gesturn</title>
    <link rel="stylesheet" href="css/estilos.css">
</head>
<body>
    <div id="web">
        <header>
            <img src="images/logo-gesturn.png" alt="Gesturn - Gestión de turnos de empresa">
            <h1>Gesturn &copy;</h1>
            <?php menu(); ?>
        </header>
        <main>
            <h1>Gestión de Turnos</h1>
            
            <?php if($mensaje != '') { echo "<p class='mensaje'>$mensaje</p>"; } ?>

            <div class="contenedor-gestion">
                <div class="lista-personal">
                    <h2>Personal</h2>
                    <div class="buscador">
                        <input type="text" id="buscador" placeholder="Buscar trabajador..." class="buscador-input">
                    </div>
                    <div class="lista-trabajadores-simple">
                        <?php foreach ($trabajadores as $trabajador): ?>
                            <div class="trabajador-item" data-nombre="<?php echo strtolower($trabajador['nombre'] . ' ' . $trabajador['apellido1'] . ' ' . $trabajador['apellido2']); ?>">
                                <?php echo $trabajador['nombre'] . ' ' . $trabajador['apellido1'] . ' ' . $trabajador['apellido2']; ?>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <div class="calendario">
                    <h2><?php echo obtener_nombre_mes($mes_actual) . ' ' . $anio_actual; ?></h2>
                    <div class="calendario-grid">
                        <div class="dia-semana">Lun</div>
                        <div class="dia-semana">Mar</div>
                        <div class="dia-semana">Mié</div>
                        <div class="dia-semana">Jue</div>
                        <div class="dia-semana">Vie</div>
                        <div class="dia-semana">Sáb</div>
                        <div class="dia-semana">Dom</div>

                        <?php 
                        // Añadir espacios en blanco para el primer día
                        for ($i = 1; $i < $primer_dia; $i++) {
                            echo '<div class="dia vacio"></div>';
                        }
                        
                        // Añadir los días del mes
                        for ($dia = 1; $dia <= $dias_mes; $dia++) {
                            echo '<div class="dia">' . $dia . '</div>';
                        }
                        ?>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const buscador = document.getElementById('buscador');
            const trabajadores = document.querySelectorAll('.trabajador-item');

            buscador.addEventListener('input', function(e) {
                const busqueda = e.target.value.toLowerCase().trim();

                trabajadores.forEach(trabajador => {
                    const nombre = trabajador.dataset.nombre;
                    const coincide = nombre.includes(busqueda);
                    trabajador.style.display = coincide ? '' : 'none';
                });
            });
        });
    </script>
</body>
</html>