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
    <title>Catálogo - Alveo & Alguilar Real Estate</title>
    <style>
        /* Estilo General */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #fff;
            color: #000;
        }

        /* Encabezado */
        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 30px;
            border-bottom: 2px solid #000;
        }
        header .logo {
            background-color: #dcdcdc;
            padding: 5px 10px;
            border-radius: 5px;
            font-size: 16px;
            font-weight: bold;
        }
        header .menu {
            font-size: 18px;
            font-weight: bold;
            letter-spacing: 1px;
        }

        /* Contenedor Principal */
        .container {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 30px;
            align-items: center;
            padding: 60px 40px;
        }

        /* Título */
        .container h1 {
            font-size: 150px;
            font-weight: bold;
            margin: 0;
            text-transform: uppercase;
            padding-left: 200px; /* Ajuste en pantallas grandes */
        }

        /* Imagen */
        .catalog-image {
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
        }
        .catalog-image img {
            width: 100%;
            max-width: 800px; /* Ajusta el tamaño máximo */
            height: auto;
        }
        .catalog-image::before,
        .catalog-image::after {
            content: '';
            position: absolute;
            top: 0;
            bottom: 0;
            width: 4px;
            background-color: #fff;
            z-index: 2;
        }
        .catalog-image::before {
            left: 50%;
            transform: translateX(-50%);
        }

        /* Botón */
        .catalog-button-container {
            grid-column: span 2;
            display: flex;
            justify-content: center;
            margin-top: 30px;
        }
        .catalog-button {
            padding: 15px 40px;
            font-size: 30px;
            font-weight: bold;
            color: #000;
            border: 2px solid #000;
            border-radius: 5px;
            background-color: #fff;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            position: relative;
            transition: all 0.3s ease;
        }
        .catalog-button:hover {
            background-color: #f9f9f9;
            transform: scale(1.05);
        }
        .catalog-button::after {
            content: '';
            position: absolute;
            right: -30px;
            top: 50%;
            transform: translateY(-50%);
            width: 20px;
            height: 20px;
            background: url('images/cursor.png') no-repeat center;
            background-size: contain;
        }

        /* Responsivo */
        @media (max-width: 1200px) {
            .container h1 {
                font-size: 100px;
                padding-left: 100px; /* Ajuste en pantallas medianas */
            }
            .catalog-image img {
                max-width: 600px; /* Reduce el tamaño máximo */
            }
        }

        @media (max-width: 768px) {
            .container {
                grid-template-columns: 1fr;
                text-align: center;
                padding: 30px 20px;
            }
            .catalog-image {
                justify-content: center;
            }
            .container h1 {
                text-align: center;
                font-size: 80px;
                margin-bottom: 20px;
                padding-left: 0; /* Elimina el ajuste en móviles */
            }
            .catalog-button {
                font-size: 20px;
            }
        }

        @media (max-width: 480px) {
            .container h1 {
                font-size: 50px;
            }
            .catalog-button {
                font-size: 16px;
                padding: 10px 20px;
            }
        }
    </style>
</head>
<body>
    <header>
        <div class="logo">CONTACTO</div>
        <div class="menu">
        <a href="dashboard.php">MENU</a>
        </div>
    </header>
    <div class="container">
        <h1>CATÁLOGO</h1>
        <div class="catalog-image">
            <img src="images/pre catalogo.webp" alt="Imagen de la Casa">
        </div>
        <div class="catalog-button-container">
            <a href="catalogo.php" class="catalog-button">VER CATÁLOGO</a>
        </div>
    </div>
</body>
</html>
