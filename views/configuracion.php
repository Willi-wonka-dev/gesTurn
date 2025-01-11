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
    <title>Configuración - Gesturn</title>
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
            <h1>Configuración del Sistema</h1>
            
            <?php if($mensaje != '') { echo "<p class='mensaje'>$mensaje</p>"; } ?>

            <div class="contenedor-configuracion">
                <div class="configuracion-general">
                    <h2>Configuraciones Generales</h2>
                    <form action="" method="POST">
                        <input type="hidden" name="accion" value="guardar_config">
                        
                        <label for="horario_laboral">Horario Laboral Estándar:</label>
                        <input type="text" name="horario_laboral" value="<?php echo $configuraciones['horario_laboral'] ?? ''; ?>">
                        
                        <label for="max_horas_turno">Máximo de Horas por Turno:</label>
                        <input type="number" name="max_horas_turno" value="<?php echo $configuraciones['max_horas_turno'] ?? ''; ?>">
                        
                        <label for="antelacion_cambio_turno">Antelación para Cambios de Turno (días):</label>
                        <input type="number" name="antelacion_cambio_turno" value="<?php echo $configuraciones['antelacion_cambio_turno'] ?? ''; ?>">
                        
                        <input type="submit" value="Guardar Configuraciones">
                    </form>
                </div>

                <div class="configuracion-usuarios">
                    <h2>Gestión de Usuarios</h2>
                    
                    <?php if ($usuario_editar): ?>
                        <div class="formulario-usuario">
                            <h3>Editar Usuario</h3>
                            <form action="" method="POST">
                                <input type="hidden" name="accion" value="editar_usuario">
                                <input type="hidden" name="id" value="<?php echo $usuario_editar['id']; ?>">
                                
                                <label for="usuario">Usuario:</label>
                                <input type="text" name="usuario" value="<?php echo $usuario_editar['usuario']; ?>" required>
                                
                                <label for="password">Nueva Contraseña (dejar en blanco para no cambiar):</label>
                                <input type="password" name="password">
                                
                                <div class="checkbox-container">
                                    <label for="admin">Admin:</label>
                                    <input type="checkbox" name="admin" <?php echo $usuario_editar['admin'] ? 'checked' : ''; ?>>
                                </div>
                                
                                <input type="submit" value="Guardar Cambios">
                            </form>
                        </div>
                    <?php else: ?>
                        <div class="contenedor-gestion-usuarios">
                            <div class="lista-usuarios">
                                <table>
                                    <thead>
                                        <tr>
                                            <th>Usuario</th>
                                            <th>Admin</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($usuarios as $usuario): ?>
                                        <tr>
                                            <td><?php echo $usuario['usuario']; ?></td>
                                            <td><?php echo $usuario['admin'] ? 'Sí' : 'No'; ?></td>
                                            <td>
                                                <a href="?editar=<?php echo $usuario['id']; ?>" class="boton-editar">Editar</a>
                                                <form action="" method="POST" class="form-eliminar">
                                                    <input type="hidden" name="accion" value="eliminar_usuario">
                                                    <input type="hidden" name="id" value="<?php echo $usuario['id']; ?>">
                                                    <button type="submit" class="boton-eliminar">Eliminar</button>
                                                </form>
                                            </td>
                                        </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>

                            <div class="formulario-usuario">
                                <h3>Agregar Usuario</h3>
                                <form action="" method="POST">
                                    <input type="hidden" name="accion" value="agregar_usuario">
                                    
                                    <label for="usuario">Usuario:</label>
                                    <input type="text" name="usuario" required>
                                    
                                    <label for="password">Contraseña:</label>
                                    <input type="password" name="password" required>
                                    
                                    <div class="checkbox-container">
                                        <label for="admin">Admin:</label>
                                        <input type="checkbox" name="admin">
                                    </div>
                                    
                                    <input type="submit" value="Agregar Usuario">
                                </form>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </main>
    </div>
</body>
</html>