<?php
$host = "localhost";
$db_user = "root"; 
$db_pass = ""; 
$db_name = "gestion_tareas";

$conn = new mysqli($host, $db_user, $db_pass, $db_name);

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}
?>