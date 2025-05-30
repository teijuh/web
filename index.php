<?php
session_start();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Inicio | Sistema de Justificantes</title>
    <link rel="icon" href="img/favicon.ico" type="image/x-icon">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #f1f1f1;
            display: flex;
            height: 100vh;
        }

        .sidebar {
            width: 240px;
            background-color: #2e7d32;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            padding: 20px;
            box-shadow: 2px 0 5px rgba(0,0,0,0.1);
        }

        .sidebar h2 {
            color: white;
            margin-bottom: 20px;
        }

        .sidebar a {
            display: block;
            padding: 10px;
            background-color: white;
            color: #2e7d32;
            margin-bottom: 10px;
            text-align: center;
            text-decoration: none;
            font-weight: bold;
            border-radius: 5px;
            transition: 0.3s;
        }

        .sidebar a:hover {
            background-color: #1b5e20;
            color: white;
        }

        .social-icons {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-top: 10px;
        }

        .social-icons a {
            font-size: 24px;
            color: #a5d6a7;
            transition: transform 0.3s ease;
        }

        .social-icons a:hover {
            transform: scale(1.2);
            color: #66bb6a;
        }

        .footer-text {
            text-align: center;
            color: white;
            font-size: 14px;
            margin-top: 10px;
        }

        .main {
            flex: 1;
            padding: 40px;
            overflow-y: auto;
            text-align: center;
        }

        .main h1 {
            color: #2e7d32;
            margin-bottom: 20px;
        }

        .main p {
            color: #444;
            font-size: 18px;
        }

        .conalep-logo {
            max-width: 200px;
            margin: 5px 0;
        }

        .carousel-img {
            width: 100%;
            max-width: 100%;
            height: 300px;
            object-fit: cover;
            border-radius: 10px;
            box-shadow: 0 1px 10px rgba(0,0,0,0.14);
        }

        .carousel-container {
            max-width: 800px;
            margin: auto;
        }
    </style>
</head>
<body>
<div class="sidebar">
    <div>
        <h2> MENU INICIO</h2>
        <a href="index.php">INICIO</a>
        <a href="nosotros.html">SOBRE NOSOTROS</a>
        <a href="carreras.html">CARRERAS</a>
        <a href="ingresar_admin.php">INICIAR COMO ADMINISTRADOR</a>
        <a href="ingresar_alumno.php">INICIAR COMO ALUMNO</a>
    </div>
    <div>
        <div class="social-icons">
            <a href="#"><i class="fab fa-facebook-square"></i></a>
            <a href="#"><i class="fab fa-twitter-square"></i></a>
            <a href="#"><i class="fab fa-instagram-square"></i></a>
        </div>
        <div class="footer-text">CONALEP CUAUTLA #173</div>
    </div>
</div>


<div class="main">
    <div style="max-width: 1200px; background-color: white; padding: 60px; border-radius: 30px; box-shadow: 0 0 14px rgba(0,0,0,0.1); text-align: center;">
        <h1 style="color: #2e7d32;">BIENVENIDO AL SISTEMA DE JUSTIFICANTES</h1>
        <img src="img/conaleplogo.png" alt="Logotipo CONALEP" class="conalep-logo">


        <hr style="margin: 0.1px ;">
        <h2 style="color: #2e7d32;">Galería Conalep</h2>

        <!-- Carrusel Bootstrap -->
        <div id="carouselExampleIndicators" class="carousel slide carousel-container" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="3"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="4"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="img/imagen1.jpeg" class="carousel-img d-block" alt="Imagen 1">
                </div>
                <div class="carousel-item">
                    <img src="img/imagen2.jpeg" class="carousel-img d-block" alt="Imagen 2">
                </div>
                <div class="carousel-item">
                    <img src="img/imagen3.jpeg" class="carousel-img d-block" alt="Imagen 3">
                </div>
                <div class="carousel-item">
                    <img src="img/imagen4.jpeg" class="carousel-img d-block" alt="Imagen 4">
                </div>
                <div class="carousel-item">
                    <img src="img/imagen5.jpeg" class="carousel-img d-block" alt="Imagen 5">
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>

        <div class="card mt-5 mx-auto" style="max-width: 700px;">
            <div class="card-body">
                <h2 class="card-title">¿QUÉ PUEDES HACER EN ESTA PÁGINA?</h2>
                <p class="card-text">En este sistema puedes consultar tus datos personales, revisar el historial de justificantes que has realizado y también generar nuevos justificantes en línea de forma rápida y sencilla.</p>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS and Popper.js -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>

</body>
</html>
