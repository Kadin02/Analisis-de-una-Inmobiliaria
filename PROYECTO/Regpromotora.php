<?php
include 'conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre_p = $conn->real_escape_string($_POST["nombre_p"]);
    $direccion = $conn->real_escape_string($_POST["direccion"]);
    $telefono = $conn->real_escape_string($_POST["telefono"]);
    $tipo_proyecto = $conn->real_escape_string($_POST["tipo_proyecto"]);

    // Manejo de la imagen
    $directorioDestino = "images/PROMOTORAS/";
    if (!is_dir($directorioDestino)) {
        mkdir($directorioDestino, 0777, true);
    }

    $imagen = $_FILES["imagen"]["name"];
    $imagenTmp = $_FILES["imagen"]["tmp_name"];
    $nombreImagenUnico = uniqid() . "_" . $imagen;

    $rutaCompleta = $directorioDestino . $nombreImagenUnico;

    if (move_uploaded_file($imagenTmp, $rutaCompleta)) {
        // Insertar en la base de datos
        $sql = "INSERT INTO PROMOTORA (NOMBRE_P, DIRECCION, TELEFONO, TIPO_PROYECTO, IMAGEN)
                VALUES ('$nombre_p', '$direccion', '$telefono', '$tipo_proyecto', '$nombreImagenUnico')";

        if ($conn->query($sql) === TRUE) {
            echo "<script>alert('Promotora registrada exitosamente.'); window.location.href = 'promotoras.php';</script>";
        } else {
            echo "<script>alert('Error al registrar la promotora: " . $conn->error . "');</script>";
        }
    } else {
        echo "<script>alert('Error al subir la imagen. Verifica permisos de la carpeta.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Promotora</title>
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
            margin-bottom: 5px;
            font-size: 14px;
        }
        input, select {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 14px;
            width: 100%;
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

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .container {
                width: 90%;
                padding: 15px;
            }
            h1 {
                font-size: 20px;
            }
            label {
                font-size: 12px;
            }
            button {
                font-size: 14px;
                padding: 8px;
            }
        }

        @media (max-width: 480px) {
            h1 {
                font-size: 18px;
            }
            button {
                font-size: 13px;
                padding: 6px;
            }
        }
    </style>
</head>
<body>
    <header>
        <a href="dashboard_usuario.php" class="back-button">← Volver</a>
    </header>
    <div class="container">
        <h1>Registrar Promotora</h1>
        <form action="" method="POST" enctype="multipart/form-data">
            <label for="nombre_p">Nombre:</label>
            <input type="text" id="nombre_p" name="nombre_p" required>

            <label for="direccion">Dirección:</label>
            <input type="text" id="direccion" name="direccion" required>

            <label for="telefono">Teléfono:</label>
            <input type="text" id="telefono" name="telefono" required>

            <label for="tipo_proyecto">Tipo de Proyecto:</label>
            <input type="text" id="tipo_proyecto" name="tipo_proyecto" required>

            <label for="imagen">Logo:</label>
            <input type="file" id="imagen" name="imagen" accept="image/*" required>

            <button type="submit">Registrar Promotora</button>
        </form>
    </div>
</body>
</html>
