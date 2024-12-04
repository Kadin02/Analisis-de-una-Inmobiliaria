<?php
include 'conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener y limpiar los datos del formulario
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
        echo "<script>alert('Error: Ya existe un cliente con esa cédula o correo.');</script>";
    } else {
        // Insertar en la tabla CLIENTES
        $sql_clientes = "INSERT INTO CLIENTES (CEDULA, NOMBRE, APELLIDO, DIRECCION, NUMERO_T, CORREO, FECHA_NACIMIENTO)
                         VALUES ('$cedula', '$nombre', '$apellido', '$direccion', '$numero_t', '$correo', '$fecha_nacimiento')";

        if ($conn->query($sql_clientes) === TRUE) {
            // Insertar en la tabla CLIENTE_CREDENCIALES
            $sql_credenciales = "INSERT INTO CLIENTE_CREDENCIALES (CEDULA_C, CONTRASEÑA)
                                 VALUES ('$cedula', '$contrasena')";
            if ($conn->query($sql_credenciales) === TRUE) {
                echo "<script>alert('Cliente registrado exitosamente.'); window.location.href = 'Gclientes.php';</script>";
            } else {
                echo "<script>alert('Error al registrar en CLIENTE_CREDENCIALES: " . $conn->error . "');</script>";
            }
        } else {
            echo "<script>alert('Error al registrar en CLIENTES: " . $conn->error . "');</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Nuevo Cliente</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        header {
            background-color: #0c3d0a;
            color: white;
            padding: 10px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        header .back-button {
            background-color: #333;
            color: white;
            padding: 8px 15px;
            border-radius: 5px;
            text-decoration: none;
            font-size: 14px;
        }
        header .back-button:hover {
            background-color: #555;
        }
        .container {
            max-width: 600px;
            margin: 40px auto;
            padding: 20px;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }
        h1 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
            font-size: 24px;
        }
        form {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }
        label {
            font-weight: bold;
            margin-top: 10px;
            font-size: 14px;
        }
        input {
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 14px;
        }
        button {
            padding: 10px;
            background-color: #0c3d0a;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }
        button:hover {
            background-color: #086307;
        }
        .back-link {
            text-align: center;
            display: block;
            margin-top: 20px;
            background-color: #0c3d0a;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
            font-size: 14px;
        }
        .back-link:hover {
            background-color: #086307;
        }
        @media (max-width: 768px) {
            .container {
                padding: 15px;
            }
            h1 {
                font-size: 20px;
            }
            button, .back-link {
                font-size: 14px;
            }
        }
    </style>
</head>
<body>
    <header>
        <a href="Gclientes.php" class="back-button">← Volver</a>
    </header>
    <div class="container">
        <h1>Registrar Nuevo Cliente</h1>
        <form action="" method="POST">
            <label for="cedula">Cédula:</label>
            <input type="text" id="cedula" name="cedula" required>

            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" required>

            <label for="apellido">Apellido:</label>
            <input type="text" id="apellido" name="apellido" required>

            <label for="direccion">Dirección:</label>
            <input type="text" id="direccion" name="direccion" required>

            <label for="numero_t">Teléfono:</label>
            <input type="text" id="numero_t" name="numero_t" required>

            <label for="correo">Correo:</label>
            <input type="email" id="correo" name="correo" required>

            <label for="contrasena">Contraseña:</label>
            <input type="password" id="contrasena" name="contrasena" required>

            <label for="fecha_nacimiento">Fecha de Nacimiento:</label>
            <input type="date" id="fecha_nacimiento" name="fecha_nacimiento" required>

            
            <button type="submit">Registrar</button>
        </form>
    </div>
</body>
</html>
