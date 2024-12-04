<?php
session_start(); // Inicia la sesión
include 'conexion.php'; // Incluye la conexión a la base de datos

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener y limpiar los datos del formulario
    $cedula = trim($conn->real_escape_string($_POST["cedula"]));
    $password = trim($conn->real_escape_string($_POST["password"]));

    // Consulta para verificar si la cédula existe
    $sql = "SELECT * FROM CLIENTE_CREDENCIALES WHERE CEDULA_C = '$cedula'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Si la cédula existe, obtenemos los datos del usuario
        $row = $result->fetch_assoc();

        // Comparar directamente las contraseñas (en texto plano)
        if ($password === $row['CONTRASEÑA']) {
            // Inicio de sesión exitoso
            $_SESSION['cedula'] = $cedula; // Guarda la cédula en la sesión
            echo "<script>setTimeout(() => { window.location.href = 'dashboard.php'; }, 2000);</script>";
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
            background-image: url('http://localhost/real_state/images/background.jpg');
            background-size: cover;
            background-position: center;
        }
        .container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            align-items: stretch;
            width: 90%;
            max-width: 900px;
            background: rgba(255, 255, 255, 0.8);
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            border-radius: 10px;
            overflow: hidden;
        }
        .logo-section {
            flex: 1;
            text-align: center;
            background-color: #f4f4f4;
            padding: 30px;
        }
        .logo-section img {
            max-width: 150px;
            height: auto;
        }
        .logo-section h1 {
            font-size: 24px;
            margin-top: 10px;
            color: #333;
        }
        .logo-section h2 {
            font-size: 16px;
            color: #555;
        }
        .login-section {
            flex: 1;
            background-color: #f9f9f9;
            padding: 30px;
        }
        .login-section form {
            display: flex;
            flex-direction: column;
        }
        .login-section label {
            margin: 10px 0 5px;
            color: #333;
            font-weight: bold;
        }
        .login-section input {
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 14px;
        }
        .login-section button {
            padding: 10px;
            background-color: #333;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
            margin-bottom: 10px;
        }
        .login-section button:hover {
            background-color: #555;
        }
        .forgot-password {
            text-decoration: none;
            color: blue;
            font-size: 14px;
            margin-bottom: 10px;
            text-align: right;
        }
        .forgot-password:hover {
            text-decoration: underline;
        }
        .menu {
            position: absolute;
            top: 10px;
            right: 20px;
            font-size: 14px;
        }
        .menu a {
            text-decoration: none;
            color: #333;
            font-weight: bold;
        }

        /* Responsive Styles */
        @media (max-width: 768px) {
            .container {
                flex-direction: column;
                align-items: center;
                text-align: center;
            }
            .logo-section {
                padding: 20px;
            }
            .login-section {
                padding: 20px;
                width: 100%;
            }
            .menu {
                top: 10px;
                right: 10px;
            }
        }

        @media (max-width: 480px) {
            .logo-section h1 {
                font-size: 20px;
            }
            .logo-section h2 {
                font-size: 14px;
            }
            .login-section button {
                font-size: 12px;
                padding: 8px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="logo-section">
            <img src="images/logoxd.png" alt="Logo de Alveo & Alguilar Real Estate">
            <h1>ALVEO & ALGUILAR</h1>
            <h2>REAL ESTATE</h2>
        </div>
        <div class="login-section">
            <form action="login.php" method="POST">
                <label for="cedula">Cédula:</label>
                <input type="text" id="cedula" name="cedula" placeholder="Ingresa tu cédula" required>
                <label for="password">Contraseña:</label>
                <input type="password" id="password" name="password" placeholder="Ingresa tu contraseña" required>
                <a href="#" class="forgot-password">¿Olvidaste tu contraseña?</a>
                <button type="submit">INICIAR SESIÓN</button>
            </form>
            <form action="registro.php" method="GET">
                <button type="submit">REGISTRARSE</button>
            </form>
        </div>
        <div class="menu">
            <a href="dashboard.php">MENU</a>
        </div>
    </div>
</body>
</html>

