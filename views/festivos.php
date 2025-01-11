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
    <title>Gestión de Días Festivos - Gesturn</title>
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
            <h1>Gestión de Días Festivos</h1>
            
            <?php if($mensaje != '') { echo "<p class='mensaje'>$mensaje</p>"; } ?>

            <div class="contenedor-festivos">
                <div class="formulario-festivo">
                    <h2><?php echo $festivo_editar ? 'Editar Día Festivo' : 'Agregar Nuevo Día Festivo'; ?></h2>
                    <form action="" method="POST">
                        <input type="hidden" name="accion" value="<?php echo $festivo_editar ? 'editar' : 'agregar'; ?>">
                        <?php if($festivo_editar): ?>
                            <input type="hidden" name="id" value="<?php echo $festivo_editar['id']; ?>">
                        <?php endif; ?>
                        <label for="fecha">Fecha:</label>
                        <input type="date" id="fecha" name="fecha" value="<?php echo $festivo_editar ? $festivo_editar['fecha'] : ''; ?>" required>
                        <label for="descripcion">Descripción:</label>
                        <input type="text" id="descripcion" name="descripcion" value="<?php echo $festivo_editar ? $festivo_editar['descripcion'] : ''; ?>" required>
                        <button type="submit"><?php echo $festivo_editar ? 'Actualizar' : 'Agregar'; ?> Día Festivo</button>
                    </form>
                </div>

                <div class="lista-festivos">
                    <h2>Lista de Días Festivos</h2>
                    <table>
                        <thead>
                            <tr>
                                <th>Fecha</th>
                                <th>Descripción</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($festivos as $festivo): ?>
                                <tr>
                                    <td><?php echo date('d/m/Y', strtotime($festivo['fecha'])); ?></td>
                                    <td><?php echo $festivo['descripcion']; ?></td>
                                    <td>
                                        <a href="?accion=editar&id=<?= $festivo['id']; ?>" class="boton-editar">Editar</a>
                                        <a href="?accion=eliminar&id=<?= $festivo['id']; ?>" class="boton-eliminar" onclick="return confirm('¿Estás seguro de que quieres eliminar este día festivo?');">Eliminar</a>
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