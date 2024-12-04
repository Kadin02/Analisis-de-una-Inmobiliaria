<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alveo & Alguilar Real Estate</title>
    <link rel="stylesheet" href="style3.css">
    <style>
        /* Estilos generales */
body {
    margin: 0;
    padding: 0;
    font-family: Arial, sans-serif;
    background-color: #ffffff;
    color: #333;
}

/* Encabezado */
.header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 20px;
    background-color: #ffffff;
    border-bottom: 1px solid #ccc;
}

.logo {
    display: flex;
    align-items: center;
    gap: 10px;
}

.logo img {
    height: 80px;
}

.logo h1 {
    font-size: 18px;
    text-transform: uppercase;
    font-weight: bold;
}

.logo span {
    font-size: 14px;
    color: #777;
}

.menu a {
    text-decoration: none;
    color: #333;
    margin: 0 15px;
    font-size: 14px;
    font-weight: bold;
}

.contacto {
    background-color: #ccc;
    padding: 5px 15px;
    border-radius: 5px;
}

.contacto:hover {
    background-color: #aaa;
}

/* Banner */
.banner img {
    width: 100%;
    height: auto;
}

/* Introducción */
.intro {
    text-align: center;
    margin: 30px 0;
}

.intro h2 {
    font-size: 24px;
    font-weight: bold;
}

.ver-mas {
    background-color: #ccc;
    border: none;
    padding: 10px 20px;
    font-size: 14px;
    font-weight: bold;
    border-radius: 5px;
    cursor: pointer;
}

.ver-mas:hover {
    background-color: #aaa;
}

/* Galería */
.galeria {
    display: flex;
    justify-content: center;
    gap: 20px;
    margin: 30px;
}

.galeria img {
    width: 30%;
    height: auto;
    border-radius: 5px;
}

    </style>
</head>
<body>
    <header class="header">
        <div class="logo">
            <img src="images/logoxd.png" alt="Logo Alveo & Alguilar">
            <h1>ALVEO & ALGUIAR <br><span>REAL ESTATE</span></h1>
        </div>
        <nav class="menu">
            <a href="login.php">INICIAR SESION</a>
            <a href="">SERVICIOS</a>
            <a href="#" class="contacto">CONTACTO</a>
        </nav>
    </header>

    <main>
        <section class="banner">
            <img src="images/index00.webp" alt="Casa principal">
        </section>
        <section class="intro">
            <h2>DESCUBRE TU NUEVO HOGAR CON NOSOTROS.</h2>
            <button class="ver-mas">VER MÁS</button>
        </section>
        <section class="galeria">
            <img src="images/casa index.png" alt="Casa moderna">
            <img src="images/index2.jpg" alt="Casas vecinas">
            <img src="images/index3.webp" alt="Casa minimalista">
        </section>
    </main>
</body>
</html>
