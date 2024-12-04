<?php
session_start(); // Inicia la sesión
include 'conexion.php'; // Incluye la conexión a la base de datos

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener y limpiar los datos del formulario
    $cedula = trim($conn->real_escape_string($_POST["cedula"]));
    $password = trim($conn->real_escape_string($_POST["password"]));

    // Consulta para verificar si la cédula existe
    $sql = "SELECT * FROM USUARIO_CREDENCIALES WHERE CEDULA_US = '$cedula'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Si la cédula existe, obtenemos los datos del usuario
        $row = $result->fetch_assoc();

        // Comparar directamente las contraseñas (en texto plano)
        if ($password === $row['CONTRASEÑA']) {
            // Inicio de sesión exitoso
            $_SESSION['cedula'] = $cedula; // Guarda la cédula en la sesión
            echo "<script>setTimeout(() => { window.location.href = 'dashboard_usuario.php'; }, 2000);</script>";
        } 
    } 
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de Sesión - Alveo & Alguilar Real Estate</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f0f0f0;
            background-image: linear-gradient(135deg, #0c3d0a, #28a745);
        }
        .container {
            width: 400px;
            background-color: #ffffff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            text-align: center;
        }
        .container h1 {
            margin-bottom: 20px;
            color: #333;
            font-size: 24px;
            font-weight: bold;
        }
        form {
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        form label {
            font-weight: bold;
            margin-top: 15px;
            text-align: left;
            width: 100%;
            font-size: 14px;
        }
        form input {
            padding: 10px;
            width: 100%;
            margin-top: 5px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 14px;
        }
        form button {
            padding: 10px;
            width: 100%;
            background-color: #0c3d0a;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            margin-top: 10px;
        }
        form button:hover {
            background-color: #086307;
        }
        .secondary-btn {
            background-color: #007bff;
            margin-top: 10px;
        }
        .secondary-btn:hover {
            background-color: #0056b3;
        }
        .forgot-password {
            font-size: 14px;
            text-decoration: none;
            color: #007bff;
            margin-top: 10px;
        }
        .forgot-password:hover {
            text-decoration: underline;
        }
        .footer-link {
            margin-top: 20px;
            font-size: 12px;
            color: #666;
        }
        .footer-link a {
            text-decoration: none;
            color: #007bff;
        }
        .footer-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Inicio de Sesión</h1>
        <form action="login_usuarios.php" method="POST">
            <label for="cedula">Cédula:</label>
            <input type="text" id="cedula" name="cedula" placeholder="Ingresa tu cédula" required>
            <label for="password">Contraseña:</label>
            <input type="password" id="password" name="password" placeholder="Ingresa tu contraseña" required>
            <a href="#" class="forgot-password">¿Olvidaste tu contraseña?</a>
            <button type="submit">Iniciar Sesión</button>
        </form>
        <form action="registro_usuario.php" method="GET">
            <button type="submit" class="secondary-btn">Crear una cuenta</button>
        </form>
 
    </div>
</body>
</html>
