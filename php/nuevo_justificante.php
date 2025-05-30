<?php
<?php
session_start();

if (!isset($_SESSION['correo'])) {
    header("Location: ../principal.php");
    exit();
}

include("conexion.php");

$correo = $_SESSION['correo'];
$mensaje = "";

// Obtener matrícula del usuario
$result = mysqli_query($conn, "SELECT matricula FROM usuarios WHERE correo = '$correo'");
$usuario = mysqli_fetch_assoc($result);
$matricula = $usuario['matricula'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fecha = $_POST['fecha'];
    $motivo = $_POST['motivo'];

    if (!empty($fecha) && !empty($motivo)) {
        $sql = "INSERT INTO justificantes (matricula, fecha, descripcion) VALUES ('$matricula', '$fecha', '$motivo')";
        if (mysqli_query($conn, $sql)) {
            $mensaje = "Justificante generado exitosamente.";
        } else {
            $mensaje = "Error al guardar el justificante.";
        }
    } else {
        $mensaje = "Por favor completa todos los campos.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Realizar Justificante</title>
     <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            background-color: #f1f1f1;
            display: flex;
            height: 100vh;
        }

        .sidebar {
            width: 220px;
            background-color: #2e7d32;
            padding: 20px;
            box-shadow: 2px 0 5px rgba(0,0,0,0.1);
        }

        .sidebar h2 {
            color: white;
            margin-bottom: 30px;
        }

        .sidebar a {
            display: block;
            margin: 15px 0;
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
        }

        .main h1 {
            color: #2e7d32;
        }

        .form-box {
            margin-top: 20px;
            background-color: white;
            padding: 25px;
            border-radius: 8px;
            box-shadow: 0 0 8px rgba(0,0,0,0.1);
            width: 400px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }

        input[type="date"],
        textarea {
            width: 100%;
            padding: 8px;
            margin-bottom: 15px;
            border-radius: 4px;
            border: 1px solid #ccc;
        }

        textarea {
            resize: vertical;
            height: 100px;
        }

        input[type="submit"] {
            background-color: #2e7d32;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        input[type="submit"]:hover {
            background-color: #1b5e20;
        }

        .mensaje {
            margin-top: 10px;
            font-weight: bold;
            color: #2e7d32;
        }
    </style>
</head>
<body>

<div class="sidebar">
    <h2>Menú</h2>
    <a href="menu.php">Inicio</a>
    <a href="datos.php">Ver mis datos</a>
    <a href="historial_justificantes.php">Historial de justificantes</a>
</div>

<div class="main">
    <h1>Realizar Justificante</h1>

    <div class="form-box">
        <form method="POST" action="">
            <label for="fecha">Fecha:</label>
            <input type="date" name="fecha" required>

            <label for="motivo">Motivo del justificante:</label>
            <textarea name="motivo" required></textarea>

            <input type="submit" value="Generar Justificante">
        </form>
        <?php if ($mensaje != ""): ?>
            <p class="mensaje"><?php echo $mensaje; ?></p>
        <?php endif; ?>
    </div>
    
</div>
<script src="bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
