<?php
session_start();

if (!isset($_SESSION['correo'])) {
    header("Location: ../principal.php");
    exit();
}

$correo = $_SESSION['correo'];

// Obtener la matrícula desde la tabla usuarios
$sql = "SELECT matricula FROM usuarios WHERE correo = '$correo'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$matricula = $row['matricula'];

// Obtener los datos del alumno con nombre_grupo y carrera desde la tabla grupos
$sql = "SELECT a.nombre, a.ap_paterno, a.ap_materno, a.edad, a.sexo, a.fecha_nacimiento, g.nombre_grupo, g.carrera 
        FROM alumnos a 
        INNER JOIN grupos g ON a.grupo_id = g.id 
        WHERE a.matricula = '$matricula'";
$result = mysqli_query($conn, $sql);
$datos = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Mis Datos</title>
  <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #e8f5e9;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .contenedor {
            background-color: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 12px rgba(0, 0, 0, 0.15);
            width: 400px;
        }

        h2 {
            color: #2e7d32;
            text-align: center;
        }

        p {
            font-size: 16px;
            margin: 10px 0;
        }

        span {
            font-weight: bold;
        }
    </style>
</head>
<body>
<div class="contenedor">
    <h2>Mis Datos</h2>
    <?php if ($datos): ?>
        <p><span>Nombre:</span> <?php echo $datos['nombre'] . " " . $datos['ap_paterno'] . " " . $datos['ap_materno']; ?></p>
        <p><span>Edad:</span> <?php echo $datos['edad']; ?></p>
        <p><span>Sexo:</span> <?php echo $datos['sexo']; ?></p>
        <p><span>Fecha de Nacimiento:</span> <?php echo $datos['fecha_nacimiento']; ?></p>
        <p><span>Grupo:</span> <?php echo $datos['nombre_grupo']; ?></p>
        <p><span>Carrera:</span> <?php echo $datos['carrera']; ?></p>
    <?php else: ?>
        <p>No se encontraron datos.</p>
    <?php endif; ?>
</div>
<script src="bootstrap/js/bootstrap.bundle.min.js"></script>

</body>
</html>
