<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro - Alveo & Alguilar Real Estate</title>
    <style>
        /* Configuración general */
        body {
            margin: 0;
            padding: 0;
            font-family: 'Arial', sans-serif;
            background-color: #b0b0b0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            width: 90%;
            max-width: 1200px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: relative;
        }

        .logo-section {
            width: 50%;
            text-align: center;
        }

        .logo {
            width: 350px;
            margin-bottom: -40px;
        }

        .form-section {
            width: 40%;
            background-color: #ffffff;
            padding: 20px 30px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }

        .form-section label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
            font-size: 14px;
            color: #333333;
        }

        .form-section input {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #cccccc;
            border-radius: 5px;
            font-size: 14px;
            color: #333333;
        }

        .form-section button {
            width: 100%;
            padding: 10px;
            background-color: #333333;
            color: #ffffff;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .form-section button:hover {
            background-color: #555555;
        }

        .form-section .secondary-btn {
            background-color: #007bff;
            margin-top: 10px;
        }

        .form-section .secondary-btn:hover {
            background-color: #0056b3;
        }

        @media (max-width: 768px) {
            .container {
                flex-direction: column;
                align-items: center;
            }

            .logo-section, .form-section {
                width: 90%;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="logo-section">
            <img src="images/logoxd.png" alt="Logo de Alveo & Alguilar Real Estate" class="logo">
            <h1>ALVEO & ALGUILAR</h1>
            <h2>REAL ESTATE</h2>
        </div>
        <div class="form-section">
            <?php
            include 'conexion.php';

            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                // Obtener datos del formulario
                $cedula = $conn->real_escape_string($_POST["cedula"]);
                $nombre = $conn->real_escape_string($_POST["nombre"]);
                $apellido = $conn->real_escape_string($_POST["apellido"]);
                $direccion = $conn->real_escape_string($_POST["direccion"]);
                $numero_t = $conn->real_escape_string($_POST["numero_t"]);
                $correo = $conn->real_escape_string($_POST["correo"]);
                $fecha_nacimiento = $conn->real_escape_string($_POST["fecha_nacimiento"]);
                $contrasena = $conn->real_escape_string($_POST["contrasena"]);

                // Verificar si la cédula o el correo ya existen
                $check_sql = "SELECT * FROM CLIENTES WHERE CEDULA = '$cedula' OR CORREO = '$correo'";
                $result = $conn->query($check_sql);

                if ($result->num_rows > 0) {
                    // Si ya existe la cédula o el correo
                    echo "<p>Error: Ya existe un cliente con esa cédula o correo.</p>";
                } else {
                    // Insertar en la tabla CLIENTES
                    $sql_clientes = "INSERT INTO CLIENTES (CEDULA, NOMBRE, APELLIDO, DIRECCION, NUMERO_T, CORREO, FECHA_NACIMIENTO)
                                     VALUES ('$cedula', '$nombre', '$apellido', '$direccion', '$numero_t', '$correo', '$fecha_nacimiento')";

                    if ($conn->query($sql_clientes) === TRUE) {
                        // Insertar en la tabla CLIENTE_CREDENCIALES
                        $sql_credenciales = "INSERT INTO CLIENTE_CREDENCIALES (CEDULA_C, CONTRASEÑA)
                                             VALUES ('$cedula', '$contrasena')";
                        if ($conn->query($sql_credenciales) === TRUE) {
                            echo "<p>Cliente registrado exitosamente en ambas tablas.</p>";
                        } else {
                            echo "<p>Error al registrar en CLIENTE_CREDENCIALES: " . $conn->error . "</p>";
                        }
                    } else {
                        echo "<p>Error al registrar en CLIENTES: " . $conn->error . "</p>";
                    }
                }
            }
            ?>

            <form action="" method="POST">
                <label for="cedula">Cédula:</label>
                <input type="text" id="cedula" name="cedula" required>

                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" name="nombre" required>

                <label for="apellido">Apellido:</label>
                <input type="text" id="apellido" name="apellido" required>

                <label for="direccion">Dirección:</label>
                <input type="text" id="direccion" name="direccion" required>

                <label for="numero_t">Número de Teléfono:</label>
                <input type="tel" id="numero_t" name="numero_t" required>

                <label for="correo">Correo:</label>
                <input type="email" id="correo" name="correo" required>

                <label for="fecha_nacimiento">Fecha de Nacimiento:</label>
                <input type="date" id="fecha_nacimiento" name="fecha_nacimiento" required>

                <label for="contrasena">Contraseña:</label>
                <input type="password" id="contrasena" name="contrasena" required>

                <button type="submit" class="submit-btn">Registrar Cliente</button>
            </form>
            <form action="login.php" method="GET">
                <button type="submit" class="secondary-btn">Iniciar Sesión</button>
            </form>
        </div>
    </div>
</body>
</html>
