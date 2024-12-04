<?php
session_start();
include 'conexion.php';

// Verifica si el usuario está logueado
if (!isset($_SESSION['cedula'])) {
    echo "<script>window.location.href = 'login_usuario.php';</script>";
    exit();
}

// Lógica para eliminar un usuario
if (isset($_GET['eliminar'])) {
    $cedula = $conn->real_escape_string($_GET['eliminar']);

    // Eliminar primero de la tabla USUARIO_CREDENCIALES
    $sql_credenciales = "DELETE FROM USUARIO_CREDENCIALES WHERE CEDULA_US = '$cedula'";
    if ($conn->query($sql_credenciales) === TRUE) {
        // Después, eliminar de la tabla ROLES_USUARIOS
        $sql_roles = "DELETE FROM ROLES_USUARIOS WHERE CEDULA_US = '$cedula'";
        if ($conn->query($sql_roles) === TRUE) {
            // Finalmente, eliminar de la tabla USUARIO_BACKOFFICE
            $sql_backoffice = "DELETE FROM USUARIO_BACKOFFICE WHERE CEDULA_U = '$cedula'";
            if ($conn->query($sql_backoffice) === TRUE) {
                echo "<script>alert('Usuario eliminado exitosamente.'); window.location.href = 'Gusuarios.php';</script>";
            } else {
                echo "<script>alert('Error al eliminar de USUARIO_BACKOFFICE: " . $conn->error . "');</script>";
            }
        } else {
            echo "<script>alert('Error al eliminar de ROLES_USUARIOS: " . $conn->error . "');</script>";
        }
    } else {
        echo "<script>alert('Error al eliminar de USUARIO_CREDENCIALES: " . $conn->error . "');</script>";
    }
}

// Consulta para obtener los usuarios junto con sus roles
$sql = "SELECT UB.CEDULA_U, UB.NOMBRE, UB.APELLIDO, UB.CORREO, UB.N_TELEFONO, UB.DIRECCION, RU.ROL
        FROM USUARIO_BACKOFFICE AS UB
        LEFT JOIN ROLES_USUARIOS AS RU ON UB.CEDULA_U = RU.CEDULA_US";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Usuarios</title>
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
        .new-user {
            display: inline-block;
            margin-bottom: 15px;
            padding: 10px 20px;
            background-color: #28a745;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-size: 14px;
        }
        .new-user:hover {
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
            .new-user, .back-link {
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
        <h1>Gestión de Usuarios</h1>
        <a href="registro_usuario.php" class="new-user">+ Nuevo Usuario</a>
        <table>
            <thead>
                <tr>
                    <th>Cédula</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Correo</th>
                    <th>Rol</th>
                    <th>Teléfono</th>
                    <th>Dirección</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()) : ?>
                    <tr>
                        <td><?php echo $row['CEDULA_U']; ?></td>
                        <td><?php echo $row['NOMBRE']; ?></td>
                        <td><?php echo $row['APELLIDO']; ?></td>
                        <td><?php echo $row['CORREO']; ?></td>
                        <td><?php echo $row['ROL'] ? $row['ROL'] : 'No asignado'; ?></td>
                        <td><?php echo $row['N_TELEFONO']; ?></td>
                        <td><?php echo $row['DIRECCION']; ?></td>
                        <td class="actions">
                            <a href="Edusuarios.php?cedula=<?php echo $row['CEDULA_U']; ?>" class="edit">Editar</a>
                            <a href="Gusuarios.php?eliminar=<?php echo $row['CEDULA_U']; ?>" class="delete" 
                               onclick="return confirm('¿Está seguro de eliminar este usuario?')">Eliminar</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
