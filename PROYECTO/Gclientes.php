<?php
session_start();
include 'conexion.php';

// Verifica si el usuario está logueado
if (!isset($_SESSION['cedula'])) {
    echo "<script>window.location.href = 'login_usuario.php';</script>";
    exit();
}

// Lógica para eliminar un cliente
if (isset($_GET['eliminar'])) {
    $cedula = $conn->real_escape_string($_GET['eliminar']);

    // Eliminar primero de la tabla CLIENTE_CREDENCIALES
    $sql_credenciales = "DELETE FROM CLIENTE_CREDENCIALES WHERE CEDULA_C = '$cedula'";
    if ($conn->query($sql_credenciales) === TRUE) {
        // Después, eliminar de la tabla CLIENTES
        $sql_clientes = "DELETE FROM CLIENTES WHERE CEDULA = '$cedula'";
        if ($conn->query($sql_clientes) === TRUE) {
            echo "<script>alert('Cliente eliminado exitosamente.'); window.location.href = 'Gclientes.php';</script>";
        } else {
            echo "<script>alert('Error al eliminar de CLIENTES: " . $conn->error . "');</script>";
        }
    } else {
        echo "<script>alert('Error al eliminar de CLIENTE_CREDENCIALES: " . $conn->error . "');</script>";
    }
}

// Consulta para obtener los clientes
$sql = "SELECT * FROM CLIENTES";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Clientes</title>
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
            max-width: 1200px;
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
        .new-client {
            display: inline-block;
            margin-bottom: 15px;
            padding: 10px 20px;
            background-color: #28a745;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-size: 14px;
        }
        .new-client:hover {
            background-color: #218838;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 10px;
            text-align: center;
        }
        th {
            background-color: #f4f4f4;
            color: #333;
        }
        .actions a {
            margin: 0 5px;
            padding: 5px 10px;
            color: white;
            text-decoration: none;
            border-radius: 3px;
            font-size: 12px;
        }
        .actions .edit {
            background-color: #007bff;
        }
        .actions .edit:hover {
            background-color: #0056b3;
        }
        .actions .delete {
            background-color: red;
        }
        .actions .delete:hover {
            background-color: darkred;
        }
        .back-link {
            display: inline-block;
            margin-top: 10px;
            text-align: center;
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
                padding: 10px;
            }
            table {
                font-size: 12px;
            }
            .new-client, .back-link {
                font-size: 12px;
                padding: 8px;
            }
        }
    </style>
</head>
<body>
    <header>
        <a href="dashboard_usuario.php" class="back-button">← Volver</a>
    </header>
    <div class="container">
        <h1>Gestión de Clientes</h1>
        <a href="Ncliente.php" class="new-client">+ Nuevo Cliente</a>
        <table>
            <thead>
                <tr>
                    <th>Cédula</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Correo</th>
                    <th>Teléfono</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()) : ?>
                    <tr>
                        <td><?php echo $row['CEDULA']; ?></td>
                        <td><?php echo $row['NOMBRE']; ?></td>
                        <td><?php echo $row['APELLIDO']; ?></td>
                        <td><?php echo $row['CORREO']; ?></td>
                        <td><?php echo $row['NUMERO_T']; ?></td>
                        <td class="actions">
                            <a href="Edcliente.php?cedula=<?php echo $row['CEDULA']; ?>" class="edit">Editar</a>
                            <a href="Gclientes.php?eliminar=<?php echo $row['CEDULA']; ?>" class="delete" 
                               onclick="return confirm('¿Está seguro de eliminar este cliente?')">Eliminar</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
