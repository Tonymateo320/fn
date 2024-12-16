<?php
session_start();
require_once 'db.php';



if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $conn->real_escape_string($_POST['username']);
    $password = $_POST['password'];

    $sql = "SELECT id, password FROM usuarios WHERE username = '$username'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            $_SESSION['usuario_id'] = $row['id'];
            header("Location: dashboard");
            exit;
        } else {
            // echo $mesajeError;
            header("Location: seccion?error=credenciales");
            exit;
        }
    } else {
        // echo $mesajeError;
        header("Location: seccion?error=credenciales");
        exit;
    }
}
?>