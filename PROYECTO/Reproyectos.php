<?php
session_start();
include 'conexion.php';

// Verifica si el usuario está logueado
if (!isset($_SESSION['cedula'])) {
    echo "<script>
            alert('Por favor, inicie sesión para acceder a esta página.');
            window.location.href = 'login_usuario.php';
          </script>";
    exit();
}

// Obtener las promotoras registradas
$sql_promotoras = "SELECT ID_PROMOTORA, NOMBRE_P FROM PROMOTORA";
$result_promotoras = $conn->query($sql_promotoras);

// Procesar el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre_proyecto = $conn->real_escape_string($_POST["nombre_proyecto"]);
    $id_promotora = $conn->real_escape_string($_POST["id_promotora"]);
    $ubicacion = $conn->real_escape_string($_POST["ubicacion"]);
    $metros_cuadrados = $conn->real_escape_string($_POST["metros_cuadrados"]);
    $tipo_proyecto = $conn->real_escape_string($_POST["tipo_proyecto"]);
    $pisos = $conn->real_escape_string($_POST["pisos"]);
    $cuartos = $conn->real_escape_string($_POST["cuartos"]);
    $banos = $conn->real_escape_string($_POST["banos"]);
    $precio = $conn->real_escape_string($_POST["precio"]);
    $descripcion = $conn->real_escape_string($_POST["descripcion"]);

    // Subida de imagen
    $imagen = null;
    if (isset($_FILES["imagen"]) && $_FILES["imagen"]["error"] == 0) {
        $ruta_destino = "images/PROYECTOS/";
        $nombre_archivo = uniqid() . "_" . basename($_FILES["imagen"]["name"]);
        $ruta_completa = $ruta_destino . $nombre_archivo;

        if (move_uploaded_file($_FILES["imagen"]["tmp_name"], $ruta_completa)) {
            $imagen = $nombre_archivo;
        } else {
            echo "<script>alert('Error al subir la imagen.');</script>";
        }
    }

    // Insertar en la tabla PROYECTOS
    $sql = "INSERT INTO PROYECTOS 
            (NOMBRE_PROYECTO, ID_PROMOTORA, UBICACION, `METROS CUADRADOS`, `TIPO PROYECTO`, PISOS, CUARTOS, BAÑOS, `PRECIO DE VENTA`, DESCRIPCION, IMAGEN) 
            VALUES 
            ('$nombre_proyecto', '$id_promotora', '$ubicacion', '$metros_cuadrados', '$tipo_proyecto', '$pisos', '$cuartos', '$banos', '$precio', '$descripcion', '$imagen')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>
                alert('Proyecto registrado exitosamente.');
                window.location.href = 'dashboard_usuario.php';
              </script>";
    } else {
        echo "<script>alert('Error al registrar el proyecto: " . $conn->error . "');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Proyecto - Alveo & Alguilar Real Estate</title>
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
        header .user-info {
            display: flex;
            flex-direction: column;
            line-height: 1.2;
        }
        header .user-info span {
            font-size: 14px;
        }
        header .logout-btn {
            background-color: red;
            color: white;
            padding: 8px 15px;
            border: none;
            border-radius: 5px;
            text-transform: uppercase;
            font-size: 12px;
            cursor: pointer;
        }
        header .logout-btn:hover {
            background-color: darkred;
        }
        .container {
            max-width: 500px;
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
        input, select, textarea {
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 14px;
            width: 100%;
        }
        textarea {
            resize: vertical;
        }
        button {
            padding: 10px;
            background-color: #0c3d0a;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            margin-top: 10px;
        }
        button:hover {
            background-color: #086307;
        }
        .back-button {
            position: absolute;
            top: 10px;
            left: 10px;
            background-color: #333;
            color: white;
            border: none;
            padding: 8px 15px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 12px;
            text-transform: uppercase;
            text-decoration: none;
        }
        .back-button:hover {
            background-color: #555;
        }
        @media (max-width: 768px) {
            .container {
                width: 90%;
                padding: 15px;
            }
        }
    </style>
</head>
<body>
    <header>
        <div class="user-info">
            <span><?php echo $_SESSION['cedula']; ?></span>
        </div>
        <button class="logout-btn" onclick="window.location.href='logout.php'">Cerrar Sesión</button>
    </header>
    <div class="container">
        <a href="dashboard_usuario.php" class="back-button">← Volver</a>
        <h1>Registrar Proyecto</h1>
        <form action="" method="POST" enctype="multipart/form-data">
            <label for="nombre_proyecto">Nombre del Proyecto:</label>
            <input type="text" id="nombre_proyecto" name="nombre_proyecto" required>

            <label for="id_promotora">Promotora:</label>
            <select id="id_promotora" name="id_promotora" required>
                <option value="" disabled selected>Seleccione una promotora</option>
                <?php while ($row = $result_promotoras->fetch_assoc()) : ?>
                    <option value="<?php echo $row['ID_PROMOTORA']; ?>">
                        <?php echo $row['NOMBRE_P']; ?>
                    </option>
                <?php endwhile; ?>
            </select>

            <label for="ubicacion">Ubicación:</label>
            <input type="text" id="ubicacion" name="ubicacion" required>

            <label for="metros_cuadrados">Metros Cuadrados:</label>
            <input type="number" id="metros_cuadrados" name="metros_cuadrados" required>

            <label for="tipo_proyecto">Tipo de Proyecto:</label>
            <input type="text" id="tipo_proyecto" name="tipo_proyecto" required>

            <label for="pisos">Pisos:</label>
            <input type="number" id="pisos" name="pisos" required>

            <label for="cuartos">Cuartos:</label>
            <input type="number" id="cuartos" name="cuartos" required>

            <label for="banos">Baños:</label>
            <input type="number" id="banos" name="banos" required>

            <label for="precio">Precio de Venta:</label>
            <input type="number" id="precio" name="precio" required>

            <label for="descripcion">Descripción:</label>
            <textarea id="descripcion" name="descripcion" rows="3" required></textarea>

            <label for="imagen">Imagen del Proyecto:</label>
            <input type="file" id="imagen" name="imagen" accept="image/*">

            <button type="submit">Registrar Proyecto</button>
        </form>
    </div>
</body>
</html>
