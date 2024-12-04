<?php
session_start();
include 'conexion.php';

// Verifica si el usuario está logueado
if (!isset($_SESSION['cedula'])) {
    echo "<script>window.location.href = 'login_usuario.php';</script>";
    exit();
}

// Consulta para obtener las visitas
$sql_visitas = "
    SELECT v.ID_VISITA, v.FECHA_VISITA, v.HORA, v.MOTIVO_VISITA, c.NOMBRE, c.NUMERO_T, c.DIRECCION 
    FROM VISITAS v
    INNER JOIN CLIENTES c ON v.CEDULA_C = c.CEDULA
    ORDER BY v.FECHA_VISITA DESC, v.HORA DESC";
$result_visitas = $conn->query($sql_visitas);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Visitas</title>
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
            padding: 10px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        header a {
            text-decoration: none;
            color: white;
            font-weight: bold;
        }
        .container {
            max-width: 1200px;
            margin: 50px auto;
            padding: 20px;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }
        h1 {
            text-align: center;
            margin-bottom: 20px;
            font-size: 24px;
            color: #333;
        }
        .new-visit {
            display: block;
            width: fit-content;
            margin: 20px auto;
            padding: 10px 20px;
            background-color: #28a745;
            color: white;
            text-align: center;
            text-decoration: none;
            border-radius: 5px;
            font-size: 16px;
        }
        .new-visit:hover {
            background-color: #218838;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table, th, td {
            border: 1px solid #ccc;
        }
        th, td {
            padding: 10px;
            text-align: center;
        }
        footer {
            text-align: center;
            margin-top: 20px;
            color: #666;
        }
    </style>
</head>
<body>
    <header>
        <a href="dashboard_usuario.php">← Volver</a>
    </header>
    <div class="container">
        <h1>Gestión de Visitas</h1>
        <a href="crear_visita.php" class="new-visit">+ Nueva Visita</a>
        <table>
            <thead>
                <tr>
                    <th>ID Visita</th>
                    <th>Fecha</th>
                    <th>Hora</th>
                    <th>Nombre Cliente</th>
                    <th>Teléfono</th>
                    <th>Dirección</th>
                    <th>Motivo</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result_visitas->num_rows > 0) : ?>
                    <?php while ($row = $result_visitas->fetch_assoc()) : ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['ID_VISITA']); ?></td>
                            <td><?php echo htmlspecialchars($row['FECHA_VISITA']); ?></td>
                            <td><?php echo htmlspecialchars($row['HORA']); ?></td>
                            <td><?php echo htmlspecialchars($row['NOMBRE']); ?></td>
                            <td><?php echo htmlspecialchars($row['NUMERO_T']); ?></td>
                            <td><?php echo htmlspecialchars($row['DIRECCION']); ?></td>
                            <td><?php echo htmlspecialchars($row['MOTIVO_VISITA']); ?></td>
                        </tr>
                    <?php endwhile; ?>
                <?php else : ?>
                    <tr>
                        <td colspan="7">No hay visitas programadas.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    <footer>© <?php echo date("Y"); ?> Alveo & Alguilar Real Estate. Todos los derechos reservados.</footer>
</body>
</html>
