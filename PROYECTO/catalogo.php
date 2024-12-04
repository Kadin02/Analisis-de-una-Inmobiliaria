<?php
session_start();
include 'conexion.php';

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['cedula'])) {
    echo "<script>
            alert('Por favor, inicie sesión para acceder al catálogo.');
            window.location.href = 'login.php';
          </script>";
    exit();
}

// Consultar las propiedades disponibles para mostrar en el catálogo
$sql = "SELECT ID_PROPIEDAD, TIPO, UBICACION, PRECIO FROM PROPIEDADES";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catálogo de Venta | Alveo & Aguilar</title>
    <style>
        /* General Reset */
        body, html {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background-color: #fff;
            color: #000;
        }

        /* Header */
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 20px;
            background-color: #141414;
            color: white;
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 1000;
        }
        .header h2 {
            margin: 0;
            font-size: 18px;
        }

        /* Main Content */
        .catalogo-main {
            margin-top: 60px;
            padding: 20px;
        }
        .propiedades {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
            justify-items: center;
        }
        .tarjeta {
            background-color: #f8f8f8;
            border: 1px solid #ddd;
            border-radius: 10px;
            text-align: center;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }
        .propiedad-img {
            width: 100%;
            height: auto;
            display: block;
        }
        .detalles {
            padding: 15px;
        }
        .detalles p {
            margin: 5px 0;
            font-size: 14px;
        }
        .btn-solicitar {
            display: inline-block;
            padding: 10px 20px;
            background-color: #007BFF;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s;
        }
        .btn-solicitar:hover {
            background-color: #0056b3;
        }

        /* Footer */
        .catalogo-footer {
            display: flex;
            justify-content: center;
            padding: 10px 20px;
            background-color: #141414;
            color: white;
            position: fixed;
            bottom: 0;
            width: 100%;
        }
        .btn-menu {
            text-decoration: none;
            color: white;
            background-color: #007BFF;
            padding: 10px 20px;
            border-radius: 5px;
            transition: background-color 0.3s;
        }
        .btn-menu:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <header class="header">
        <h2>ALVEO & AGUILAR | CATÁLOGO DE COMPRA</h2>
    </header>
    <main class="catalogo-main">
        <section class="propiedades">
            <?php if ($result->num_rows > 0) : ?>
                <?php while ($row = $result->fetch_assoc()) : ?>
                    <div class="tarjeta">
                        <div class="detalles">
                            <p><strong><?php echo htmlspecialchars($row['TIPO']); ?></strong></p>
                            <p>Ubicación: <strong><?php echo htmlspecialchars($row['UBICACION']); ?></strong></p>
                            <p>Precio de venta: <strong>$<?php echo number_format($row['PRECIO'], 2); ?></strong></p>
                            <a href="solicitar.php?id=<?php echo $row['ID_PROPIEDAD']; ?>" class="btn-solicitar">SOLICITAR</a>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php else : ?>
                <p>No hay propiedades disponibles en el catálogo.</p>
            <?php endif; ?>
        </section>
    </main>
    <footer class="catalogo-footer">
        <a href="menu.php" class="btn-menu">MENU</a>
    </footer>
</body>
</html>
