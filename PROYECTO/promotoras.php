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

// Consulta para obtener las promotoras
$sql = "SELECT * FROM PROMOTORA";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Promotoras - Alveo & Alguilar Real Estate</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            color: #333;
        }
        header {
            background-color: #0c3d0a;
            color: white;
            padding: 15px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        header .title {
            font-size: 18px;
            font-weight: bold;
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
            max-width: 1200px;
            margin: 40px auto;
            padding: 20px;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }
        .back-button {
            display: inline-block;
            margin-bottom: 20px;
            padding: 10px 15px;
            background-color: #333;
            color: white;
            border-radius: 5px;
            text-decoration: none;
            font-size: 14px;
        }
        .back-button:hover {
            background-color: #555;
        }
        h1 {
            text-align: center;
            margin-bottom: 30px;
            color: #333;
            font-size: 28px;
        }
        .add-promotora-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }
        .add-promotora-container h2 {
            font-size: 20px;
            font-weight: bold;
            margin: 0;
        }
        .add-promotora {
            display: inline-block;
            padding: 10px 20px;
            background-color: #28a745;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-size: 16px;
        }
        .add-promotora:hover {
            background-color: #218838;
        }
        .promotoras-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(400px, 1fr));
            gap: 20px;
        }
        .promotora-card {
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 10px;
            padding: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
        }
        .promotora-card:hover {
            transform: scale(1.02);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
        }
        .promotora-details {
            flex: 1;
            padding-right: 20px;
        }
        .promotora-details p {
            margin: 8px 0;
            font-size: 14px;
        }
        .promotora-details a {
            text-decoration: none;
            color: #0c3d0a;
            font-size: 16px;
            font-weight: bold;
        }
        .promotora-details a:hover {
            text-decoration: underline;
        }
        .promotora-logo {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: 50%;
        }
        @media (max-width: 768px) {
            .promotora-card {
                flex-direction: column;
                text-align: center;
            }
            .promotora-details {
                padding-right: 0;
            }
        }
    </style>
</head>
<body>
    <header>
        <div class="title">Promotoras Registradas</div>
        <button class="logout-btn" onclick="window.location.href='logout.php'">Cerrar Sesión</button>
    </header>
    <div class="container">
        <a href="dashboard_usuario.php" class="back-button">← Volver</a>
        <div class="add-promotora-container">
            <h2>Promotoras Registradas</h2>
            <a href="Regpromotora.php" class="add-promotora">+ Nueva Promotora</a>
        </div>
        <div class="promotoras-grid">
            <?php while ($row = $result->fetch_assoc()) : ?>
                <div class="promotora-card">
                    <div class="promotora-details">
                        <p><strong>Nombre:</strong> <a href="Promproyectos.php?id_promotora=<?php echo $row['ID_PROMOTORA']; ?>"><?php echo htmlspecialchars($row['NOMBRE_P']); ?></a></p>
                        <p><strong>Dirección:</strong> <?php echo htmlspecialchars($row['DIRECCION']); ?></p>
                        <p><strong>Teléfono:</strong> <?php echo htmlspecialchars($row['TELEFONO']); ?></p>
                        <p><strong>Tipo de proyectos:</strong> <?php echo htmlspecialchars($row['TIPO_PROYECTO']); ?></p>
                    </div>
                    <img src="images/promotoras/<?php echo htmlspecialchars($row['IMAGEN']); ?>" alt="Logo de <?php echo htmlspecialchars($row['NOMBRE_P']); ?>" class="promotora-logo">
                </div>
            <?php endwhile; ?>
        </div>
    </div>
</body>
</html>
