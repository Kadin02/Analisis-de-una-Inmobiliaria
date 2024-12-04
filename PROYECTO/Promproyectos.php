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

// Verifica si se proporcionó el ID de la promotora
if (!isset($_GET['id_promotora'])) {
    echo "<script>
            alert('ID de promotora no proporcionado.');
            window.location.href = 'promotoras.php';
          </script>";
    exit();
}

$id_promotora = $conn->real_escape_string($_GET['id_promotora']);

// Consulta para obtener los datos de la promotora
$sql_promotora = "SELECT * FROM PROMOTORA WHERE ID_PROMOTORA = '$id_promotora'";
$result_promotora = $conn->query($sql_promotora);
$promotora = $result_promotora->fetch_assoc();

// Consulta para obtener los proyectos asociados
$sql_proyectos = "SELECT NOMBRE_PROYECTO, UBICACION, `TIPO PROYECTO`, IMAGEN FROM PROYECTOS WHERE ID_PROMOTORA = '$id_promotora'";
$result_proyectos = $conn->query($sql_proyectos);

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proyectos de <?php echo htmlspecialchars($promotora['NOMBRE_P']); ?></title>
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
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s ease-in-out;
        }
        .proyecto-card:hover {
            transform: scale(1.05);
        }
        .proyecto-logo {
            width: 100px;
            height: 100px;
            object-fit: cover;
            border-radius: 10px;
        }
        .proyecto-details {
            flex-grow: 1;
            margin-right: 20px;
        }
        .proyecto-name {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 5px;
        }
        .proyecto-details p {
            margin: 5px 0;
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
        <h1>Proyectos de <?php echo htmlspecialchars($promotora['NOMBRE_P']); ?></h1>
        <div class="proyectos-grid">
            <?php while ($row = $result_proyectos->fetch_assoc()) : ?>
                <div class="proyecto-card">
                    <div class="proyecto-details">
                        <p class="proyecto-name">Nombre: <?php echo htmlspecialchars($row['NOMBRE_PROYECTO']); ?></p>
                        <p>Dirección: <?php echo htmlspecialchars($row['UBICACION']); ?></p>
                        <p>Tipo de proyecto: <?php echo htmlspecialchars($row['TIPO PROYECTO']); ?></p>
                    </div>
                    <img src="images/PROYECTOS/<?php echo htmlspecialchars($row['IMAGEN']); ?>" alt="Imagen de <?php echo htmlspecialchars($row['NOMBRE_PROYECTO']); ?>" class="proyecto-logo">
                </div>
            <?php endwhile; ?>
        </div>
        <a href="promotoras.php" class="back-link">Volver a Promotoras</a>
    </div>
</body>
</html>
