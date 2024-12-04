<?php
session_start();
include 'conexion.php';

// Verifica si el cliente está logueado
if (!isset($_SESSION['cedula'])) {
    echo "<script>
            alert('Por favor, inicie sesión para acceder a esta página.');
            window.location.href = 'login.php';
          </script>";
    exit();
}

$cedula = $_SESSION['cedula'];

// Consulta para obtener el nombre del cliente
$sql = "SELECT NOMBRE FROM CLIENTES WHERE CEDULA = '$cedula'";
$result = $conn->query($sql);
$nombre = "Cliente";

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $nombre = $row['NOMBRE'];
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel del Cliente - Alveo & Alguilar Real Estate</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #fff;
            color: #000;
        }
        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #fff;
            padding: 15px 30px;
            border-bottom: 2px solid #000;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        header .logo {
            display: flex;
            align-items: center;
        }
        header .logo img {
            width: 100px;
            margin-right: 20px;
        }
        header .logo span {
            font-size: 20px;
            font-weight: bold;
            color: #333;
        }
        header .menu {
            font-size: 18px;
            font-weight: bold;
            cursor: pointer;
            color: #333;
        }
        .container {
            text-align: center;
            padding: 40px 20px;
        }
        .container h1 {
            font-size: 32px;
            margin-bottom: 30px;
            color: #444;
        }
        .services {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 30px;
            padding: 20px;
        }
        .service {
            background-color: #f9f9f9;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .service:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 14px rgba(0, 0, 0, 0.2);
        }
        .service img {
            width: 60px;
            margin-bottom: 15px;
        }
        .service a {
            text-decoration: none;
            color: #333;
            font-size: 16px;
            font-weight: bold;
            display: block;
            margin-top: 10px;
        }
        .service a:hover {
            color: #0c3d0a;
        }
        .logout {
            margin-top: 30px;
        }
        .logout a {
            padding: 10px 20px;
            background-color: red;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-size: 16px;
        }
        .logout a:hover {
            background-color: darkred;
        }
        @media (max-width: 768px) {
            header {
                flex-direction: column;
                align-items: center;
                text-align: center;
            }
            header .logo img {
                width: 80px;
                margin-right: 0;
            }
            header .logo span {
                font-size: 18px;
            }
            .container h1 {
                font-size: 24px;
            }
        }
    </style>
</head>
<body>
    <header>
        <div class="logo">
            <img src="images/logo.png" alt="Logo Alveo & Alguilar">
            <span>ALVEO & ALGUILAR REAL ESTATE</span>
        </div>
        <div class="menu">MENÚ</div>
    </header>
    <div class="container">
        <h1>Bienvenido, <?php echo htmlspecialchars($nombre); ?></h1>
        <div class="services">
            <div class="service">
                <a href="precatalogo.php">
                    <img src="images/nuevosP.webp" alt="Catálogo Viviendas">
                    <p>CATÁLOGO VIVIENDAS</p>
                </a>
            </div>
            <div class="service">
                <a href="Proyectosc.php">
                    <img src="images/PROMOTORAS.png" alt="Proyectos">
                    <p>PROYECTOS</p>
                </a>
            </div>
            <div class="service">
                <a href="alquilar_propiedad.php">
                    <img src="images/alquilar.png" alt="Alquilar Propiedad">
                    <p>ALQUILAR MI PROPIEDAD</p>
                </a>
            </div>
            <div class="service">
                <a href="registrar_propiedad.php">
                    <img src="images/reg.avif" alt="Registrar Propiedad">
                    <p>REGISTRAR PROPIEDAD</p>
                </a>
            </div>
            <div class="service">
                <a href="contratos.php">
                    <img src="images/contratos.png" alt="Contratos">
                    <p>CONTRATOS</p>
                </a>
            </div>
            <div class="service">
                <a href="contactos.php">
                    <img src="images/contactos.png" alt="Contactos">
                    <p>CONTACTOS</p>
                </a>
            </div>
        </div>
        <div class="logout">
            <a href="logout_c.php">Cerrar Sesión</a>
        </div>
    </div>
</body>
</html>
