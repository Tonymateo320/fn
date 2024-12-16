<?php
require_once 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $conn->real_escape_string($_POST['username']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hashear la contraseña

    $sql = "INSERT INTO usuarios (username, password) VALUES ('$username', '$password')";

    if ($conn->query($sql) === TRUE) {
        echo "Usuario registrado con éxito.";
        header("Location: seccion");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>