<?php
if (!defined('BloqueoIncludes')) {
    echo "Acceso directo - No permitido";
    exit;
}
?><!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Trabajadores - Gesturn</title>
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
            <h1>Gestión de Trabajadores</h1>
            
            <?php if($mensaje != '') { echo "<p class='mensaje'>$mensaje</p>"; } ?>

            <?php if($trabajador_editar): ?>
                <div class="contenedor-trabajadores">
                    <div class="formulario-trabajador">
                        <h2>Editar Trabajador</h2>
                        <form id="trabajador-editar" action="trabajadores.php" method="POST" enctype="multipart/form-data">
                            <div id="tr-editar">   
                                <div class="izq">
                                    <input type="hidden" name="accion" value="Editar">
                                    <input type="hidden" name="id" value="<?php echo $trabajador_editar['id']; ?>">
                                    <label for="nombre">Nombre:</label>
                                    <input type="text" name="nombre" value="<?php echo $trabajador_editar['nombre']; ?>" required>
                                    <input type="text" name="apellido1" value="<?php echo $trabajador_editar['apellido1']; ?>" required>
                                    <input type="text" name="apellido2" value="<?php echo $trabajador_editar['apellido2']; ?>" required>
                                    <label for="email">Email:</label>
                                    <input type="email" name="email" value="<?php echo $trabajador_editar['email']; ?>">
                                    <label for="telefono">Teléfono:</label>
                                    <input type="tel" name="telefono" value="<?php echo $trabajador_editar['telefono']; ?>">
                                    <label for="fContrato">Fecha de Contrato:</label>
                                    <input type="date" name="fContrato" value="<?php echo $trabajador_editar['fContrato']; ?>">
                                    <label for="fFinContrato">Fecha de finalización de contrato:</label>
                                    <input type="date" name="fFinContrato" value="<?php echo $trabajador_editar['fFinContrato']; ?>">
                                    <label for="direccion">Dirección:</label>
                                    <textarea name="direccion"><?php echo $trabajador_editar['direccion']; ?></textarea>
                                </div>
                                <div class="der">                 
                                    <label for="fNacimiento">Fecha de Nacimiento:</label>
                                    <input type="date" name="fNacimiento" value="<?php echo $trabajador_editar['fNacimiento']; ?>">    
                                    <label for="dni">DNI:</label>
                                    <input type="text" name="dni" value="<?php echo $trabajador_editar['dni']; ?>">
                                    <label for="foto">Foto:</label>
                                    <input type="file" name="foto" accept="image/jpeg">
                                    <?php if (file_exists(IMAGEN_CARPETA . $trabajador_editar['id'] . '.jpg')): ?>
                                        <img src="<?php echo IMAGEN_CARPETA . $trabajador_editar['id'] . '.jpg'; ?>" alt="Foto del trabajador" style="max-width: 100px;">
                                    <?php endif; ?>  
                                </div>
                            </div>
                            <input type="submit" value="Guardar Cambios">
                        </form>
                    </div>
                </div>
            <?php else: ?>
                <div class="contenedor-trabajadores">
                    <div class="formulario-trabajador">
                        <h2>Agregar Nuevo Trabajador</h2>
                        <form id="trabajador-anadir" action="trabajadores.php" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="accion" value="Agregar">
                            <label for="nombre">Nombre:</label>
                            <input type="text" name="nombre" required>
                            <label for="apellido1">Primer Apellido:</label>
                            <input type="text" name="apellido1" required>
                            <label for="apellido2">Segundo Apellido:</label>
                            <input type="text" name="apellido2" required>
                            <label for="telefono">Teléfono:</label>
                            <input type="tel" name="telefono">
                            <label for="fContrato">Fecha de Contrato:</label>
                            <input type="date" name="fContrato">
                            <label for="fFinContrato">Fecha de finalización de contrato:</label>
                            <input type="date" name="fFinContrato">
                            <label for="dni">DNI:</label>
                            <input type="text" name="dni">
                            <label for="direccion">Dirección:</label>
                            <textarea name="direccion"></textarea>
                            <label for="fNacimiento">Fecha de Nacimiento:</label>
                            <input type="date" name="fNacimiento">
                            <label for="email">Email:</label>
                            <input type="email" name="email">
                            <label for="foto">Foto:</label>
                            <input type="file" name="foto" accept="image/jpeg">
                            <input type="submit" value="Agregar Trabajador">
                        </form>
                    </div>

                    <div class="lista-trabajadores">
                        <h2>Lista de Trabajadores</h2>
                        <div class="buscador">
                            <input type="text" id="buscador" placeholder="Buscar trabajador..." class="buscador-input">
                        </div>
                        <div class="tabla-trabajadores">
                            <div class="fila encabezado">    
                                <div class="foto">Foto</div>
                                <div class="nombre">Nombre</div>
                                <div class="telefono">Teléfono</div>
                                <div class="acciones">Acciones</div>
                            </div>    
                            <?php foreach ($trabajadores as $trabajador): ?>
                                <div class="fila trabajador-fila" 
                                     data-nombre="<?php echo strtolower($trabajador['nombre'] . ' ' . $trabajador['apellido1'] . ' ' . $trabajador['apellido2']); ?>"
                                     data-telefono="<?php echo $trabajador['telefono']; ?>"
                                     data-dni="<?php echo strtolower($trabajador['dni']); ?>">
                                    <div class="foto">
                                        <?php if (file_exists(IMAGEN_CARPETA . $trabajador['id'] . '.jpg')): ?>
                                            <img src="<?php echo IMAGEN_CARPETA . $trabajador['id'] . '.jpg'; ?>" alt="Foto de <?php echo $trabajador['nombre']; ?>" style="max-width: 50px; max-height: 50px;">
                                        <?php else: ?>
                                            <img src="images/trabajadores/default.png" alt="Foto por defecto" style="max-width: 50px; max-height: 50px;">
                                        <?php endif; ?>
                                    </div>
                                    <div class="nombre"><?php echo $trabajador['nombre'] . ' ' . $trabajador['apellido1'] . ' ' . $trabajador['apellido2']; ?></div>
                                    <div class="telefono"><?php echo $trabajador['telefono']; ?></div>
                                    <div class="acciones">
                                        <a href="trabajadores.php?accion=ver&id=<?php echo $trabajador['id']; ?>" class="boton-editar">Editar</a>
                                        <a href="trabajadores.php?accion=borrar&id=<?php echo $trabajador['id']; ?>" 
                                           class="boton-eliminar" 
                                           onclick="return confirm('¿Estás seguro de que quieres eliminar este trabajador?');">
                                            Borrar
                                        </a>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </main>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const buscador = document.getElementById('buscador');
            const trabajadores = document.querySelectorAll('.trabajador-fila');

            buscador.addEventListener('input', function(e) {
                const busqueda = e.target.value.toLowerCase().trim();

                trabajadores.forEach(trabajador => {
                    const nombre = trabajador.dataset.nombre;
                    const telefono = trabajador.dataset.telefono;
                    const dni = trabajador.dataset.dni;
                    
                    const coincide = nombre.includes(busqueda) || 
                                   telefono.includes(busqueda) || 
                                   dni.includes(busqueda);
                    
                    trabajador.style.display = coincide ? '' : 'none';
                });
            });
        });
    </script>
</body>
</html>