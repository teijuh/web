<?php
session_start();

if (!isset($_SESSION['correo'])) {
    header("Location: ../principal.php");
    exit();
}

include("conexion.php");
$correo = $_SESSION['correo'];

// Validar que sea un alumno
$rolQuery = "SELECT rol FROM usuarios WHERE correo = '$correo'";
$rolResultado = mysqli_query($conn, $rolQuery);
$rolDatos = mysqli_fetch_assoc($rolResultado);

if (!$rolDatos || $rolDatos['rol'] !== 'alumno') {
    header("Location: menuadmin.php");
    exit();
}

// Obtener datos del alumno
$query = "SELECT a.nombre, a.ap_paterno, a.ap_materno, a.edad, a.sexo, a.fecha_nacimiento, g.nombre_grupo AS grupo, g.carrera 
          FROM alumnos a
          JOIN usuarios u ON a.matricula = u.matricula
          JOIN grupos g ON a.grupo_id = g.id
          WHERE u.correo = '$correo'";
$resultado = mysqli_query($conn, $query);
$datos = mysqli_fetch_assoc($resultado);

// Ruta de foto
$foto = "../img/perfil/" . $_SESSION['correo'] . ".jpg";
if (!file_exists($foto)) {
    $foto = "../img/perfil/sinfoto.png";
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Menú Alumno</title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            height: 100vh;
            margin: 0;
            background-color: #f1f1f1;
        }

        .sidebar {
            width: 220px;
            background-color: #2e7d32;
            padding: 20px;
            box-shadow: 2px 0 5px rgba(0,0,0,0.1);
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .sidebar h2 {
            color: white;
            margin-bottom: 20px;
        }

        .sidebar a {
            display: block;
            margin: 10px 0;
            padding: 10px;
            background-color: white;
            color: #2e7d32;
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

        .main {
            flex: 1;
            padding: 40px;
            text-align: center;
        }

        .main h1 {
            color: #2e7d32;
        }

        .info {
            margin-top: 30px;
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 8px rgba(0,0,0,0.1);
            text-align: left;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
        }

        .social-icons {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-top: 20px;
        }

        .social-icons a {
            font-size: 28px;
            color: #a5d6a7;
            transition: transform 0.3s ease;
        }

        .social-icons a:hover {
            transform: scale(1.2);
            color: #66bb6a;
        }

        .footer-text {
            color: white;
            text-align: center;
            margin-top: 10px;
            font-weight: bold;
        }

        .text-center img {
            border-radius: 50%;
            box-shadow: 0 0 10px rgba(0,0,0,0.3);
        }

        .conalep-logo {
            margin-top: 20px;
            max-width: 150px;
        }
    </style>
</head>
<body>

<div class="sidebar">
    <div>
        <h2>MENÚ</h2>
        <a href="verdatos.php">VER MIS DATOS</a>
        <a href="historial.php">HISTORIAL DE JUSTIFICANTES</a>
        <a href="nuevo_justificante.php">REALIZAR JUSTIFICANTE</a>
    </div>

    <div>
        <div class="social-icons">
            <a href="#"><i class="fab fa-facebook-square"></i></a>
            <a href="#"><i class="fab fa-twitter-square"></i></a>
            <a href="#"><i class="fab fa-instagram-square"></i></a>
        </div>
        <a href="../logout.php" style="margin-top: 20px;">CERRAR SESIÓN</a>
        <div class="footer-text">CONALEP CUAUTLA #173</div>
    </div>
</div>

<div class="main">
    <h1>¡BIENVENIDO, <?php echo $datos['nombre'] . " " . $datos['ap_paterno'] . " " . $datos['ap_materno']; ?>!</h1>

    <div class="text-center mb-4">
        <img src="<?php echo $foto; ?>" alt="Foto de perfil" width="150" height="150">
    </div>

    <form method="POST" action="cargararchivos.php" enctype="multipart/form-data" class="text-center mb-4">
        <input type="file" name="fotoperfil" class="form-control mb-2" required>
        <input type="submit" value="Subir Foto" name="subir" class="btn btn-success">
    </form>

    <div class="info">
        <h2>INFORMACIÓN DEL SISTEMA</h2>
        <p>En este panel puedes realizar justificantes, consultar tu historial y ver tus datos registrados.</p>
    </div>
</div>

<script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
