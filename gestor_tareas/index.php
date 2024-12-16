<?php
session_start();
$error = "";

if (isset($_SESSION['usuario_id'])) {
    header("Location: dashboard");
    exit;
}

$error = isset($_GET['error']) ? $_GET['error'] : '';
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Tareas - Login</title>
    <link rel="shortcut icon" href="./img/logo.ico" type="image/x-icon">
    <link rel="stylesheet" href="./css/estilos.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>

    <div class="form-container">

        <h2>Iniciar Sesión</h2>
        <form action="login.php" method="post">
            <input type="text" name="username" placeholder="Nombre de usuario" autocomplete="off" pattern="[a-zA-Z]{3,15 }" required>
            <input type="password" name="password" placeholder="Contraseña" pattern="[a-zA-Z0-9*/#$%&.-_]{3,20 }" required>
            <button type="submit">Entrar</button>
        </form>
        <p>¿No tienes una cuenta? <a href="registro">Regístrate aquí</a></p>
    </div>

    <script>
        // Mostrar alerta de error si es necesario
        document.addEventListener('DOMContentLoaded', function() {
            const error = "<?php echo $error; ?>";
            if (error === 'credenciales') {
                Swal.fire({
                    icon: 'error',
                    title: 'Error de Inicio de Sesión',
                    text: 'Nombre de usuario o contraseña incorrectos. Por favor, inténtalo de nuevo.',
                    footer: 'Verifica tus credenciales'
                }).then((result) => {

                    if (result.isConfirmed) {
                        // borrar la url
                        setTimeout(() => {
                            window.history.replaceState(null, null, window.location.pathname);
                        }, 100);


                    }
                })
            }
        });
    </script>
    <script src="js.js"></script>
</body>

</html>