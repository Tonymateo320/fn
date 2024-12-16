<?php
require_once 'db.php';

function obtenerTareas($usuario_id, $conn)
{
    $tareas = array();
    $sql = "SELECT * FROM tareas WHERE usuario_id = $usuario_id ORDER BY completada, fecha_creacion DESC";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $tareas[] = $row;
        }
    }
    return $tareas;
}

function agregarTarea($usuario_id, $titulo, $descripcion, $conn)
{
    $titulo = $conn->real_escape_string($titulo);
    $descripcion = $conn->real_escape_string($descripcion);
    $sql = "INSERT INTO tareas (usuario_id, titulo, descripcion) VALUES ($usuario_id, '$titulo', '$descripcion')";
    return $conn->query($sql);
}

function eliminarTarea($tarea_id, $conn)
{
    $sql = "DELETE FROM tareas WHERE id = $tarea_id";
    return $conn->query($sql);
}

function actualizarTarea($tarea_id, $titulo, $descripcion, $conn)
{
    $titulo = $conn->real_escape_string($titulo);
    $descripcion = $conn->real_escape_string($descripcion);
    $sql = "UPDATE tareas SET titulo = '$titulo', descripcion = '$descripcion' WHERE id = $tarea_id";
    return $conn->query($sql);
}

function completarTarea($tarea_id, $estado, $conn)
{
    $sql = "UPDATE tareas SET completada = $estado WHERE id = $tarea_id";
    return $conn->query($sql);
}
?>