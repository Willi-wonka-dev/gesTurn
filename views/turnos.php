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

            <!-- Primera sección: Grupos -->
            <div class="contenedor-grupos">
                <div class="formulario-grupo">
                    <h2>Agregar Nuevo Grupo</h2>
                    <form id="grupos" action="turnos.php" method="POST">
                        <input type="hidden" name="accion" value="AñadirGrupo">
                        <label for="nombre">Nombre del Grupo:</label>
                        <input type="text" name="nombre" required>
                        <label for="tipo">Tipo:</label>
                        <select name="tipo" required>
                            <option value="fijo">Fijo</option>
                            <option value="rotativo">Rotativo</option>
                        </select>
                        <label for="descripcion">Descripción:</label>
                        <textarea name="descripcion"></textarea>
                        <input type="submit" value="Añadir Grupo">
                    </form>
                </div>

                <div class="lista-grupos">
    <h2>Lista de Grupos</h2>
    <table>
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Tipo</th>
                <th>Descripción</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($grupos as $grupo): ?>
                <tr>
                    <td><?php echo $grupo['nombre']; ?></td>
                    <td><?php echo $grupo['tipo']; ?></td>
                    <td><?php echo $grupo['descripcion']; ?></td>
                    <td>
                        <a href="turnos.php?accion=editar_grupo&id=<?php echo $grupo['id']; ?>" class="boton-editar">Editar</a>
                        <a href="turnos.php?accion=borrar_grupo&id=<?php echo $grupo['id']; ?>" 
                           class="boton-eliminar" 
                           onclick="return confirm('¿Estás seguro de que quieres eliminar este grupo?');">
                            Borrar
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php if($grupo_editar): ?>
    <div class="formulario-grupo">
        <h2>Editar Grupo</h2>
        <form action="turnos.php" method="POST">
            <input type="hidden" name="accion" value="EditarGrupo">
            <input type="hidden" name="id" value="<?php echo $grupo_editar['id']; ?>">
            
            <label for="nombre">Nombre del Grupo:</label>
            <input type="text" name="nombre" value="<?php echo $grupo_editar['nombre']; ?>" required>
            
            <label for="tipo">Tipo:</label>
            <select name="tipo" required>
                <option value="fijo" <?php echo $grupo_editar['tipo'] == 'fijo' ? 'selected' : ''; ?>>Fijo</option>
                <option value="rotativo" <?php echo $grupo_editar['tipo'] == 'rotativo' ? 'selected' : ''; ?>>Rotativo</option>
            </select>
            
            <label for="descripcion">Descripción:</label>
            <textarea name="descripcion"><?php echo $grupo_editar['descripcion']; ?></textarea>
            
            <input type="submit" value="Guardar Cambios">
        </form>
    </div>
<?php endif; ?>
            </div>

            <!-- Segunda sección: Turnos -->
            <div class="contenedor-turnos">
                <div class="formulario-turno">
                    <h2><?php echo $turno_editar ? 'Editar Turno' : 'Añadir Nuevo Turno'; ?></h2>
                    <form id="turnos" action="turnos.php" method="POST">
                        <input type="hidden" name="accion" value="<?php echo $turno_editar ? 'Editar' : 'Añadir'; ?>">
                        <?php if($turno_editar): ?>
                            <input type="hidden" name="id" value="<?php echo $turno_editar['id']; ?>">
                        <?php endif; ?>
                        
                        <label for="nombre">Nombre:</label>
                        <input type="text" name="nombre" value="<?php echo $turno_editar ? $turno_editar['nombre'] : ''; ?>" required>
                        
                        <label for="inicio">Hora de inicio:</label>
                        <input type="time" name="inicio" value="<?php echo $turno_editar ? $turno_editar['inicio'] : ''; ?>" required>
                        
                        <label for="fin">Hora de finalización:</label>
                        <input type="time" name="fin" value="<?php echo $turno_editar ? $turno_editar['fin'] : ''; ?>" required>
                        
                        <label for="personas_requeridas">Personas requeridas:</label>
                        <input type="number" name="personas_requeridas" value="<?php echo $turno_editar ? $turno_editar['personas_requeridas'] : '0'; ?>" required>
                        
                        <label for="horas">Horas:</label>
                        <input type="number" name="horas" value="<?php echo $turno_editar ? $turno_editar['horas'] : ''; ?>" required>

                        <label for="grupo_id">Grupo:</label>
                        <select name="grupo_id">
                            <option value="">Sin grupo</option>
                            <?php foreach ($grupos as $grupo): ?>
                                <option value="<?php echo $grupo['id']; ?>" 
                                    <?php echo ($turno_editar && $turno_editar['grupo_id'] == $grupo['id']) ? 'selected' : ''; ?>>
                                    <?php echo $grupo['nombre']; ?> (<?php echo $grupo['tipo']; ?>)
                                </option>
                            <?php endforeach; ?>
                        </select>

                        <input type="submit" value="<?php echo $turno_editar ? 'Guardar Cambios' : 'Añadir Turno'; ?>">
                    </form>
                </div>

                <div class="lista-turnos">
                    <h2>Lista de Turnos</h2>
                    <table>
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Inicio</th>
                                <th>Fin</th>
                                <th>Personas</th>
                                <th>Horas</th>
                                <th>Grupo</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($turnos as $turno): ?>
                                <tr>
                                    <td><?php echo $turno['nombre']; ?></td>
                                    <td><?php echo $turno['inicio']; ?></td>
                                    <td><?php echo $turno['fin']; ?></td>
                                    <td><?php echo $turno['personas_requeridas']; ?></td>
                                    <td><?php echo $turno['horas']; ?></td>
                                    <td>
                                        <?php 
                                        foreach ($grupos as $grupo) {
                                            if ($grupo['id'] == $turno['grupo_id']) {
                                                echo $grupo['nombre'] . ' (' . $grupo['tipo'] . ')';
                                                break;
                                            }
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <a href="turnos.php?accion=editar&id=<?php echo $turno['id']; ?>" class="boton-editar">Editar</a>
                                        <a href="turnos.php?accion=borrar&id=<?php echo $turno['id']; ?>" 
                                           class="boton-eliminar" 
                                           onclick="return confirm('¿Estás seguro de que quieres eliminar este turno?');">
                                            Borrar
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>
</body>
</html>