<?php
session_start();
require_once 'functions.php';

if (!isset($_SESSION['usuario_id'])) {
    header("Location: seccion");
    exit;
}

$usuario_id = $_SESSION['usuario_id'];

// Obtener el nombre de usuario para mostrarlo en la barra de navegación
$sql_usuario = "SELECT username FROM usuarios WHERE id = $usuario_id";
$result_usuario = $conn->query($sql_usuario);
$nombre_usuario = ($result_usuario && $result_usuario->num_rows > 0) ? $result_usuario->fetch_assoc()['username'] : "Usuario";

if (isset($_POST['agregar'])) {
    agregarTarea($usuario_id, $_POST['titulo'], $_POST['descripcion'], $conn);
}

if (isset($_POST['eliminar'])) {
    eliminarTarea($_POST['eliminar'], $conn);
}

if (isset($_POST['actualizar'])) {
    actualizarTarea($_POST['actualizar'], $_POST['titulo'], $_POST['descripcion'], $conn);
}

if (isset($_POST['completar'])) {
    completarTarea($_POST['completar'], 1, $conn);
}

if (isset($_POST['descompletar'])) {
    completarTarea($_POST['descompletar'], 0, $conn);
}

$tareas = obtenerTareas($usuario_id, $conn);
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Tareas</title>
    <link rel="shortcut icon" href="./img/logo.ico"type="image/x-icon">
    <link rel="stylesheet" href="./css/estilos.css">
</head>

<body>
    
    <nav class="navbar">
        <div class="nav-container">
            <a href="dashboard" class="nav-logo">Gestión de Tareas</a>
            <ul class="nav-menu">
                <li class="nav-item">
                    <span class="nav-links">
                        Hola,
                        <?php echo htmlspecialchars($nombre_usuario); ?>
                    </span>
                </li>
                <li class="nav-item">
                    <a href="https://sites.google.com/view/creadoresproyecto/inicio?authuser=0" target="_blank" class="nav-links nav_extra">Creadores</a>
                </li>

                <li class="nav-item">
                    <a href="logout.php" class="nav-links nav_extra">Cerrar Sesión</a>
                </li>

                
            </ul>
        </div>
    </nav>
    <div class="container">
        <h2>Agregar Tarea</h2>
        <form action="dashboard" method="post">
            <input type="text" name="titulo" placeholder="Título" required>
            <textarea name="descripcion" placeholder="Descripción"></textarea>
            <button type="submit" name="agregar">Agregar</button>
        </form>

        <h2>Tareas Pendientes</h2>
        <div class="tareas-container">
            <?php $hayPendientes = false;
            foreach ($tareas as $tarea):
                if (!$tarea['completada']):
                    $hayPendientes = true; ?>
                    <div class="tarea" data-id="<?= $tarea['id'] ?>">
                        <div class="tarea-header">
                            <h3>
                                <?= htmlspecialchars($tarea['titulo']) ?>
                            </h3>
                            <div class="tarea-actions">
                                <input type="checkbox" class="completar-tarea" data-id="<?= $tarea['id'] ?>">
                                <button class="edit-tarea">Editar</button>
                                <button class="delete-tarea">Eliminar</button>
                            </div>
                        </div>
                        <div class="tarea-body">
                            <p>
                                <?= htmlspecialchars($tarea['descripcion']) ?>
                            </p>
                        </div>
                    </div>
                <?php endif;
            endforeach;
            if (!$hayPendientes): ?>
                <p>No hay tareas pendientes.</p>
            <?php endif; ?>
        </div>
        <hr>
        <h2>Tareas Completadas</h2>

        <div class="tareas-container">
            <?php $hayCompletadas = false;
            foreach ($tareas as $tarea):
                if ($tarea['completada']):
                    $hayCompletadas = true; ?>
                    <div class="tarea completada" data-id="<?= $tarea['id'] ?>">
                        <div class="tarea-header">
                            <h3>
                                <?= htmlspecialchars($tarea['titulo']) ?>
                            </h3>
                            <div class="tarea-actions">
                                <input type="checkbox" class="completar-tarea" data-id="<?= $tarea['id'] ?>" checked>
                                <button class="delete-tarea">Eliminar</button>
                            </div>
                        </div>
                        <div class="tarea-body">
                            <p>
                                <?= htmlspecialchars($tarea['descripcion']) ?>
                            </p>
                        </div>
                    </div>
                <?php endif;
            endforeach;
            if (!$hayCompletadas): ?>
                <p>No hay tareas completadas.</p>
            <?php endif; ?>
        </div>
    </div>
    <div class="modal" id="editModal">
        <div class="modal-content">
            <span class="close-modal">&times;</span>
            <h2>Editar Tarea</h2>
            <form action="dashboard" method="post" id="editForm">
                <input type="hidden" name="actualizar" id="editId">
                <input type="text" name="titulo" id="editTitulo" placeholder="Título" required>
                <textarea name="descripcion" id="editDescripcion"  placeholder="Descripción"></textarea>
                <button type="submit">Actualizar</button>
            </form>
        </div>
    </div>
  
    <script src="./java_scrtipt/js.js"></script>
</body>

</html>