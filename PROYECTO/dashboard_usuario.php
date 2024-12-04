<?php
session_start();
include 'conexion.php';


if (!isset($_SESSION['cedula'])) {
    echo "<script>
            alert('Por favor, inicie sesión para acceder a esta página.');
            window.location.href = 'login_usuario.php';
          </script>";
    exit();
}

$cedula = $_SESSION['cedula'];


$sql = "SELECT UB.NOMBRE, RU.ROL 
        FROM USUARIO_BACKOFFICE UB 
        INNER JOIN ROLES_USUARIOS RU ON UB.CEDULA_U = RU.CEDULA_US 
        WHERE UB.CEDULA_U = '$cedula'";

$result = $conn->query($sql);
$nombre = "Usuario";
$rol = "Sin Rol Asignado";

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $nombre = $row['NOMBRE'];
    $rol = $row['ROL'];
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Alveo & Alguilar Real Estate</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
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
        .dashboard-container {
            text-align: center;
            padding: 40px 20px;
        }
        .dashboard-container h1 {
            font-size: 36px;
            margin-bottom: 20px;
        }
        .dashboard-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 20px;
            max-width: 800px;
            margin: 0 auto;
        }
        .dashboard-card {
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            text-align: center;
            transition: transform 0.3s ease;
        }
        .dashboard-card:hover {
            transform: translateY(-10px);
        }
        .dashboard-card img {
            width: 50px;
            height: 50px;
            margin-bottom: 15px;
        }
        .dashboard-card a {
            display: block;
            text-decoration: none;
            color: #333;
            font-weight: bold;
            font-size: 14px;
            margin-top: 10px;
        }
        .dashboard-card a:hover {
            color: #0c3d0a;
        }
        footer {
            text-align: center;
            margin-top: 30px;
            font-size: 12px;
            color: #666;
        }
        @media (max-width: 768px) {
            header {
                flex-direction: column;
                align-items: flex-start;
            }
        }
    </style>
</head>
<body>
    <header>
        <div class="user-info">
            <span><?php echo htmlspecialchars($nombre); ?></span>
            <span><?php echo htmlspecialchars($rol); ?></span>
        </div>
        <button class="logout-btn" onclick="window.location.href='logout.php'">Cerrar Sesión</button>
    </header>
    <div class="dashboard-container">
        <h1>Bienvenido</h1>
        <div class="dashboard-grid">
            <div class="dashboard-card">
                <img src="images/CLIENTES.png" alt="Gestión de Clientes">
                <a href="Gclientes.php">Gestión de Clientes</a>
            </div>
            <div class="dashboard-card">
                <img src="images/USUARIOS.webp" alt="Gestión de Usuarios">
                <a href="Gusuarios.php">Gestión de Usuarios</a>
            </div>
            <div class="dashboard-card">
                <img src="images/PROMOTORAS.png" alt="Promotoras">
                <a href="promotoras.php">Promotoras</a>
            </div>
            <div class="dashboard-card">
                <img src="images/nuevosP.webp" alt="Nuevos Proyectos">
                <a href="Reproyectos.php">Nuevos Proyectos</a>
            </div>
            <div class="dashboard-card">
                <img src="images/visita.webp" alt="Gestión de Visitas">
                <a href="Gvisitas.php">Visitas</a>
            </div>
        </div>
    </div>
    <footer>
        © <?php echo date("Y"); ?> Alveo & Alguilar Real Estate. Todos los derechos reservados.
    </footer>
</body>
</html>
