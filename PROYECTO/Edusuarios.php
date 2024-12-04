<?php
include 'conexion.php';

// Obtener la cédula del usuario a editar
$cedula = $_GET['cedula'];

// Procesar el formulario si se envía
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $conn->real_escape_string($_POST["nombre"]);
    $apellido = $conn->real_escape_string($_POST["apellido"]);
    $direccion = $conn->real_escape_string($_POST["direccion"]);
    $telefono = $conn->real_escape_string($_POST["telefono"]);
    $correo = $conn->real_escape_string($_POST["correo"]);
    $fecha_nacimiento = $conn->real_escape_string($_POST["fecha_nacimiento"]);

    // Actualizar los datos del usuario
    $sql = "UPDATE USUARIO_BACKOFFICE 
            SET NOMBRE = '$nombre', 
                APELLIDO = '$apellido', 
                DIRECCION = '$direccion', 
                N_TELEFONO = '$telefono', 
                CORREO = '$correo', 
                FECHA_NACIMIENTO = '$fecha_nacimiento' 
            WHERE CEDULA_U = '$cedula'";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Usuario actualizado exitosamente.'); window.location.href = 'Gusuarios.php';</script>";
    } else {
        echo "<script>alert('Error al actualizar el usuario: " . $conn->error . "');</script>";
    }
}

// Obtener los datos actuales del usuario
$sql = "SELECT * FROM USUARIO_BACKOFFICE WHERE CEDULA_U = '$cedula'";
$result = $conn->query($sql);
$usuario = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuario</title>
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
        <a href="Gusuarios.php" class="back-button">← Volver</a>
    </header>
    <div class="container">
        <h1>Editar Usuario</h1>
        <form action="" method="POST">
            <label for="cedula">Cédula:</label>
            <input type="text" id="cedula" value="<?php echo $usuario['CEDULA_U']; ?>" disabled>

            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" value="<?php echo $usuario['NOMBRE']; ?>" required>

            <label for="apellido">Apellido:</label>
            <input type="text" id="apellido" name="apellido" value="<?php echo $usuario['APELLIDO']; ?>" required>

            <label for="direccion">Dirección:</label>
            <input type="text" id="direccion" name="direccion" value="<?php echo $usuario['DIRECCION']; ?>" required>

            <label for="telefono">Teléfono:</label>
            <input type="text" id="telefono" name="telefono" value="<?php echo $usuario['N_TELEFONO']; ?>" required>

            <label for="correo">Correo:</label>
            <input type="email" id="correo" name="correo" value="<?php echo $usuario['CORREO']; ?>" required>

            <label for="fecha_nacimiento">Fecha de Nacimiento:</label>
            <input type="date" id="fecha_nacimiento" name="fecha_nacimiento" value="<?php echo $usuario['FECHA_NACIMIENTO']; ?>" required>

            <button type="submit">Actualizar</button>
        </form>
    </div>
</body>
</html>