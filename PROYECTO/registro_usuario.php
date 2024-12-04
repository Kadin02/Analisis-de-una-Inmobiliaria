<?php
include 'conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cedula = $conn->real_escape_string($_POST["cedula"]);
    $nombre = $conn->real_escape_string($_POST["nombre"]);
    $apellido = $conn->real_escape_string($_POST["apellido"]);
    $correo = $conn->real_escape_string($_POST["correo"]);
    $direccion = $conn->real_escape_string($_POST["direccion"]);
    $telefono = $conn->real_escape_string($_POST["telefono"]);
    $fecha_nacimiento = $conn->real_escape_string($_POST["fecha_nacimiento"]);
    $contrasena = $conn->real_escape_string($_POST["contrasena"]);
    $rol = $conn->real_escape_string($_POST["rol"]);

    $check_sql = "SELECT * FROM USUARIO_BACKOFFICE WHERE CEDULA_U = '$cedula'";
    $result = $conn->query($check_sql);

    if ($result->num_rows > 0) {
        echo "<p style='color:red;'>Error: Ya existe un usuario con esa cédula.</p>";
    } else {
        $conn->begin_transaction();
        try {
            $sql_usuario = "INSERT INTO USUARIO_BACKOFFICE (CEDULA_U, NOMBRE, APELLIDO, CORREO, DIRECCION, N_TELEFONO, FECHA_NACIMIENTO)
                            VALUES ('$cedula', '$nombre', '$apellido', '$correo', '$direccion', '$telefono', '$fecha_nacimiento')";
            $conn->query($sql_usuario);

            $sql_credenciales = "INSERT INTO USUARIO_CREDENCIALES (CEDULA_US, CONTRASEÑA) VALUES ('$cedula', '$contrasena')";
            $conn->query($sql_credenciales);

            $sql_roles = "INSERT INTO ROLES_USUARIOS (CEDULA_US, ROL) VALUES ('$cedula', '$rol')";
            $conn->query($sql_roles);

            $conn->commit();
            echo "<p style='color:green;'>Usuario registrado exitosamente.</p>";
        } catch (Exception $e) {
            $conn->rollback();
            echo "<p style='color:red;'>Error al registrar el usuario: " . $e->getMessage() . "</p>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Usuario</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        header {
            background-color: #0c3d0a;
            color: white;
            padding: 10px 20px;
            display: flex;
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
            font-size: 14px;
        }
        input, select {
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
        <a href="Gusuarios.php" class="back-button">← Volver</a>
    </header>
    <div class="container">
        <h1>Registrar Usuario</h1>
        <form action="" method="POST">
            <label for="cedula">Cédula:</label>
            <input type="text" id="cedula" name="cedula" required>

            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" required>

            <label for="apellido">Apellido:</label>
            <input type="text" id="apellido" name="apellido" required>

            <label for="correo">Correo:</label>
            <input type="email" id="correo" name="correo" required>

            <label for="direccion">Dirección:</label>
            <input type="text" id="direccion" name="direccion" required>

            <label for="telefono">Número de Teléfono:</label>
            <input type="tel" id="telefono" name="telefono" required>

            <label for="fecha_nacimiento">Fecha de Nacimiento:</label>
            <input type="date" id="fecha_nacimiento" name="fecha_nacimiento" required>

            <label for="contrasena">Contraseña:</label>
            <input type="password" id="contrasena" name="contrasena" required>

            <label for="rol">Rol:</label>
            <select id="rol" name="rol" required>
                <option value="GERENTE">Gerente</option>
                <option value="SUPERVISOR">Supervisor</option>
                <option value="PERSONAL ADMINISTRATIVO">Personal Administrativo</option>
            </select>

            <button type="submit">Registrar Usuario</button>
        </form>
    </div>
</body>
</html>
