<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Tareas - Registro</title>
    <link rel="shortcut icon" href="./img/logo.ico"type="image/x-icon">
    <link rel="stylesheet" href="./css/estilos.css">
</head>
<body>
    
        <div class="form-container">
            <h2>Registro de Usuario</h2>
            <form action="procesarRegistro.php" method="post">
                <input type="text" name="username" placeholder="Nombre de usuario" required>
                <input type="password" name="password" placeholder="Contraseña" required>
                <button type="submit">Registrarse</button>
            </form>
            <p>¿Ya tienes una cuenta? <a href="seccion">Inicia sesión aquí</a></p>
        </div>
  
    <script src="./java_scrtipt/js.js"></script>
</body>
</html>