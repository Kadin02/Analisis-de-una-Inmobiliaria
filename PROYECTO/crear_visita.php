<?php
include 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $cedula_c = $conn->real_escape_string($_POST['cedula_c']);
    $id_propiedad = $conn->real_escape_string($_POST['id_propiedad']);
    $fecha_visita = $conn->real_escape_string($_POST['fecha_visita']);
    $hora = $conn->real_escape_string($_POST['hora']);
    $motivo_visita = $conn->real_escape_string($_POST['motivo_visita']);

    // Verificar si el cliente existe
    $sql_cliente = "SELECT * FROM CLIENTES WHERE CEDULA = '$cedula_c'";
    $result_cliente = $conn->query($sql_cliente);

    if ($result_cliente->num_rows === 0) {
        echo "<script>alert('El cliente no está registrado. No se puede agendar la visita.');</script>";
    } else {
        // Verificar si el cliente tiene la propiedad registrada
        $sql_propiedad = "SELECT * FROM PROPIEDADES_CLIENTES WHERE CEDULA_C = '$cedula_c' AND ID_PROPIEDAD = '$id_propiedad'";
        $result_propiedad = $conn->query($sql_propiedad);

        if ($result_propiedad->num_rows === 0) {
            echo "<script>alert('El cliente no tiene registrada la propiedad indicada. No se puede agendar la visita.');</script>";
        } else {
            // Insertar la visita en la tabla
            $sql_visita = "INSERT INTO VISITAS (CEDULA_C, ID_PROPIEDAD, FECHA_VISITA, HORA, MOTIVO_VISITA) 
                           VALUES ('$cedula_c', '$id_propiedad', '$fecha_visita', '$hora', '$motivo_visita')";

            if ($conn->query($sql_visita) === TRUE) {
                echo "<script>alert('Visita registrada exitosamente.'); window.location.href = 'Gvisitas.php';</script>";
            } else {
                echo "<script>alert('Error al registrar la visita: " . $conn->error . "');</script>";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nueva Visita</title>
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
        header .user-info {
            display: flex;
            flex-direction: column;
            line-height: 1.2;
        }
        header .user-info span {
            font-size: 14px;
        }
        .back-button {
            display: inline-block;
            margin: 20px;
            padding: 10px 15px;
            background-color: #333;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-size: 14px;
            text-transform: uppercase;
            font-weight: bold;
        }
        .back-button:hover {
            background-color: #555;
        }
        .container {
            max-width: 500px;
            margin: 20px auto;
            padding: 20px;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }
        h1 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }
        form {
            display: flex;
            flex-direction: column;
        }
        label {
            margin-top: 10px;
            font-weight: bold;
        }
        input, textarea {
            padding: 8px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        textarea {
            resize: vertical;
        }
        button {
            margin-top: 20px;
            padding: 10px;
            background-color: #0c3d0a;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover {
            background-color: #086307;
        }
    </style>
</head>
<body>
    <header>
        <div class="user-info">
            <span>      </span>
            <span>      </span>
        </div>
    </header>
    <a href="Gvisitas.php" class="back-button">← Volver</a>
    <div class="container">
        <h1>Nueva Visita</h1>
        <form action="" method="POST">
            <label for="cedula_c">Cédula Cliente:</label>
            <input type="text" id="cedula_c" name="cedula_c" required>
            
            <label for="id_propiedad">ID Propiedad:</label>
            <input type="number" id="id_propiedad" name="id_propiedad" required>
            
            <label for="fecha_visita">Fecha de Visita:</label>
            <input type="date" id="fecha_visita" name="fecha_visita" required>
            
            <label for="hora">Hora:</label>
            <input type="time" id="hora" name="hora" required>
            
            <label for="motivo_visita">Motivo de la Visita:</label>
            <textarea id="motivo_visita" name="motivo_visita" rows="3" required></textarea>
            
            <button type="submit">Registrar Visita</button>
        </form>
    </div>
</body>
</html>
