<?php
session_start();

if (!isset($_SESSION['correo'])) {
    header("Location: ../principal.php");
    exit();
}

include("conexion.php");
$correo = $_SESSION['correo'];

// Consultamos el rol del usuario
$rolQuery = "SELECT rol FROM usuarios WHERE correo = '$correo'";
$rolResultado = mysqli_query($conn, $rolQuery);
$rolDatos = mysqli_fetch_assoc($rolResultado);

// Validamos que el usuario sea administrador
if (!$rolDatos || $rolDatos['rol'] !== 'administrador') {
    // Si no es administrador, lo regresamos al menú normal o al login
    header("Location: menu.php"); // O usa: header("Location: ../index.php");
    exit();
}

// Si es administrador, obtenemos sus datos
$query = "SELECT a.nombre, a.ap_paterno, a.ap_materno, a.edad, a.sexo, g.nombre_grupo AS grupo, g.carrera 
          FROM alumnos a
          JOIN usuarios u ON a.matricula = u.matricula
          JOIN grupos g ON a.grupo_id = g.id
          WHERE u.correo = '$correo'";
$resultado = mysqli_query($conn, $query);
$datos = mysqli_fetch_assoc($resultado);
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Menú Admin</title>
    <link rel="stylesheet" href="../estilo.css">
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">

    <!-- Font Awesome para iconos -->
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
        }

        .conalep-logo {
            margin-top: 30px;
            max-width: 250px;
            width: 100%;
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
    </style>
</head>
<body>

<div class="sidebar">
    <div>
        <h2>MENU </h2>
        <a href="../funciones/registraralumno.php">REGISTRAR NUEVO ALUMNO</a>
        <a href="../funciones/modificaralumno.php">MODIFICAR ALUMNO</a>
        <a href="../funciones/eliminaralumno.php">ELIMINAR ALUMNO</a>
    </div>

    <div>
        <div class="social-icons">
            <a href="#" target="_blank"><i class="fab fa-facebook-square"></i></a>
            <a href="#" target="_blank"><i class="fab fa-twitter-square"></i></a>
            <a href="#" target="_blank"><i class="fab fa-instagram-square"></i></a>
        </div>

        <a href="../logout.php" style="margin-top: 20px;">CERRAR SESION</a>
        <div class="footer-text">CONALEP CUAUTLA #173</div>
    </div>
</div>

<div class="main">
    <h1>¡BIENVENIDO, <?php echo isset($datos) ? $datos['nombre'] . " " . $datos['ap_paterno'] . " " . $datos['ap_materno'] : $_SESSION['correo']; ?>!</h1>

    <?php
// Ruta de la foto basada en el correo del usuario
$foto = "../img/perfil/" . $_SESSION['correo'] . ".jpg";
if (!file_exists($foto)) {
    $foto = "../img/perfil/sinfoto.png"; // o .jpg si tu sinfoto es JPG
}
?>

<!-- Mostrar la foto de perfil -->
<div class="text-center mb-4">
    <img src="<?php echo $foto; ?>" alt="Foto de perfil" width="150" height="150" style="border-radius: 50%; box-shadow: 0 0 10px rgba(0,0,0,0.3);">
</div>

<!-- Formulario para subir nueva foto -->
<form method="POST" action="cargararchivos.php" enctype="multipart/form-data" class="text-center mb-4">
    <input type="file" name="fotoperfil" class="form-control mb-2" required>
    <input type="submit" value="Subir Foto" name="subir" class="btn btn-success">
</form>


    <div class="info">
        <h2>PANEL DE ADMINISTRACION</h2>
        <p>Aquí puedes gestionar los alumnos: registrar nuevos, modificar los datos existentes o eliminar alumnos que ya no estén activos.</p>
    </div>
</div>
<script src="bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
