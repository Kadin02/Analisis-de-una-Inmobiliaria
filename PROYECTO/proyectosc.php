<?php
session_start();
include 'conexion.php';

// Verifica si el cliente está logueado
if (!isset($_SESSION['cedula'])) {
    echo "<script>
            alert('Por favor, inicie sesión para acceder a esta página.');
            window.location.href = 'login_cliente.php';
          </script>";
    exit();
}

// Consulta para obtener los proyectos disponibles
$sql_proyectos = "SELECT NOMBRE_PROYECTO, UBICACION, `PRECIO DE VENTA`, IMAGEN FROM PROYECTOS";
$result_proyectos = $conn->query($sql_proyectos);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proyectos Disponibles</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
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
            color: #333;
        }
        .proyectos-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
        }
        .proyecto-card {
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            text-align: center;
            transition: transform 0.2s ease-in-out;
        }
        .proyecto-card:hover {
            transform: scale(1.05);
        }
        .proyecto-logo {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-radius: 10px;
            margin-bottom: 10px;
        }
        .proyecto-details p {
            margin: 5px 0;
        }
        .btn-solicitar {
            display: inline-block;
            padding: 10px 20px;
            background-color: #007BFF;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 10px;
            transition: background-color 0.3s ease;
        }
        .btn-solicitar:hover {
            background-color: #0056b3;
        }
        .back-link {
            display: block;
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #333;
            color: white;
            text-decoration: none;
            text-align: center;
            border-radius: 5px;
            font-size: 16px;
            width: fit-content;
            margin-left: auto;
            margin-right: auto;
        }
        .back-link:hover {
            background-color: #555;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Proyectos Disponibles</h1>
        <div class="proyectos-grid">
            <?php if ($result_proyectos->num_rows > 0): ?>
                <?php while ($row = $result_proyectos->fetch_assoc()): ?>
                    <div class="proyecto-card">
                        <img src="images/PROYECTOS/<?php echo htmlspecialchars($row['IMAGEN']); ?>" alt="Imagen de <?php echo htmlspecialchars($row['NOMBRE_PROYECTO']); ?>" class="proyecto-logo">
                        <div class="proyecto-details">
                            <p class="proyecto-name"><?php echo htmlspecialchars($row['NOMBRE_PROYECTO']); ?></p>
                            <p>Ubicación: <?php echo htmlspecialchars($row['UBICACION']); ?></p>
                            <p>Precio de venta: $<?php echo number_format($row['PRECIO DE VENTA'], 2); ?></p>
                            <a href="solicitar_proyecto.php?nombre=<?php echo urlencode($row['NOMBRE_PROYECTO']); ?>" class="btn-solicitar">Solicitar</a>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <p>No hay proyectos disponibles en este momento.</p>
            <?php endif; ?>
        </div>
        <a href="dashboard_cliente.php" class="back-link">Volver al Dashboard</a>
    </div>
</body>
</html>
