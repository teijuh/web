<?php
session_start();

if (!isset($_SESSION['correo'])) {
    header("Location: ../principal.php");
    exit();
}
include("../php/conexion.php");
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registrar Alumno</title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #e8f5e9;
            margin: 0;
            padding: 40px 0;
            display: flex;
            justify-content: center;
            align-items: flex-start; /* Para que empiece desde arriba */
            min-height: 100vh;
        }

        .form-container {
            background-color: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 12px rgba(0, 0, 0, 0.15);
            width: 350px;
        }

        h2 {
            text-align: center;
            color: #2e7d32;
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-top: 15px;
            font-weight: bold;
            color: #444;
        }

        input[type="text"],
        input[type="email"],
        input[type="number"],
        input[type="date"],
        select {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        input[type="submit"] {
            margin-top: 25px;
            width: 100%;
            padding: 10px;
            background-color: #2e7d32;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
        }

        input[type="submit"]:hover {
            background-color: #1b5e20;
        }
    </style>
</head>
<body>

<div class="form-container">
    <h2>Registrar Alumno</h2>
    <form method="POST" action="guardaralumno.php">
        <label for="matricula">Matrícula</label>
        <input type="text" name="matricula" required>

        <label for="nombre">Nombre</label>
        <input type="text" name="nombre" required>

        <label for="ap_paterno">Apellido Paterno</label>
        <input type="text" name="ap_paterno" required>

        <label for="ap_materno">Apellido Materno</label>
        <input type="text" name="ap_materno" required>

        <label for="edad">Edad</label>
        <input type="number" name="edad" required>

        <label for="fecha_nacimiento">Fecha de Nacimiento</label>
        <input type="date" name="fecha_nacimiento" required>

        <label for="sexo">Sexo</label>
        <select name="sexo" required>
            <option value="">Selecciona...</option>
            <option value="M">Masculino</option>
            <option value="F">Femenino</option>
        </select>

        <label for="grupo_id">ID del Grupo</label>
        <input type="number" name="grupo_id" required>

        <input type="submit" value="Registrar Alumno">
    </form>
</div>
<script src="bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
