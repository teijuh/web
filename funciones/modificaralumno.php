<?php
session_start();

if (!isset($_SESSION['correo'])) {
    header("Location: ../principal.php");
    exit();
}
include("../php/conexion.php");

$datos_alumno = null;
$mensaje = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['buscar'])) {
        $matricula = $_POST['matricula'];
        $query = "SELECT * FROM alumnos WHERE matricula = '$matricula'";
        $resultado = mysqli_query($conn, $query);
        if ($resultado && mysqli_num_rows($resultado) > 0) {
            $datos_alumno = mysqli_fetch_assoc($resultado);
        } else {
            $mensaje = "No se encontró un alumno con esa matrícula.";
        }
    } elseif (isset($_POST['modificar'])) {
        $matricula = $_POST['matricula'];
        $nombre = $_POST['nombre'];
        $ap_paterno = $_POST['ap_paterno'];
        $ap_materno = $_POST['ap_materno'];
        $edad = $_POST['edad'];
        $sexo = $_POST['sexo'];
        $fecha_nacimiento = $_POST['fecha_nacimiento'];
        $grupo_id = $_POST['grupo_id'];

        $update = "UPDATE alumnos SET 
                    nombre='$nombre', 
                    ap_paterno='$ap_paterno', 
                    ap_materno='$ap_materno', 
                    edad='$edad', 
                    sexo='$sexo', 
                    fecha_nacimiento='$fecha_nacimiento', 
                    grupo_id='$grupo_id'
                   WHERE matricula='$matricula'";

        if (mysqli_query($conn, $update)) {
            $mensaje = "Alumno modificado correctamente.";
            $datos_alumno = null;
        } else {
            $mensaje = "Error al modificar: " . mysqli_error($conn);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Modificar Alumno</title>
      <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #e8f5e9;
            display: flex;
            justify-content: center;
            align-items: flex-start;
            min-height: 100vh;
            margin: 0;
            padding: 40px 0;
        }

        .contenedor {
            background-color: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 0 12px rgba(0, 0, 0, 0.15);
            width: 450px;
        }

        h2 {
            background-color: #c8e6c9;
            padding: 12px;
            text-align: center;
            border-radius: 10px;
            color: #2e7d32;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            font-weight: bold;
            margin-top: 12px;
        }

        input, select, button {
            padding: 8px;
            margin-top: 4px;
            border-radius: 6px;
            border: 1px solid #ccc;
        }

        .botones {
            display: flex;
            justify-content: space-between;
            gap: 10px;
            margin-top: 15px;
        }

        button {
            background-color: white;
            color: #2e7d32;
            border: 0px solid #2e7d32;
            font-weight: bold;
            cursor: pointer;
            transition: background 0.3s, color 0.3s;
        }

        button:hover {
            background-color: #2e7d32;
            color: white;
        }

        .mensaje {
            text-align: center;
            color: green;
            margin: 10px 0;
        }

        .error {
            color: red;
        }
    </style>
</head>
<body>
<div class="contenedor">
    <h2>Modificar Alumno</h2>

    <?php if ($mensaje): ?>
        <div class="mensaje <?php echo ($datos_alumno ? '' : 'error'); ?>"><?php echo $mensaje; ?></div>
    <?php endif; ?>

    <form method="POST">
        <?php if (!$datos_alumno): ?>
            <label for="matricula">Matrícula del alumno:</label>
            <input type="text" name="matricula" required>
            <button type="button" onclick="window.location.href='../php/menuadmin.php'">Inicio</button>
            <button type="submit" name="buscar">Buscar</button>
        <?php else: ?>
            <input type="hidden" name="matricula" value="<?php echo $datos_alumno['matricula']; ?>">

            <label>Nombre:</label>
            <input type="text" name="nombre" value="<?php echo $datos_alumno['nombre']; ?>" required>

            <label>Apellido Paterno:</label>
            <input type="text" name="ap_paterno" value="<?php echo $datos_alumno['ap_paterno']; ?>" required>

            <label>Apellido Materno:</label>
            <input type="text" name="ap_materno" value="<?php echo $datos_alumno['ap_materno']; ?>" required>

            <label>Edad:</label>
            <input type="number" name="edad" value="<?php echo $datos_alumno['edad']; ?>" required>

            <label>Sexo:</label>
            <select name="sexo" required>
                <option value="M" <?php if ($datos_alumno['sexo'] == 'M') echo 'selected'; ?>>Masculino</option>
                <option value="F" <?php if ($datos_alumno['sexo'] == 'F') echo 'selected'; ?>>Femenino</option>
            </select>

            <label>Fecha de Nacimiento:</label>
            <input type="date" name="fecha_nacimiento" value="<?php echo $datos_alumno['fecha_nacimiento']; ?>" required>

            <label>ID del Grupo:</label>
            <input type="number" name="grupo_id" value="<?php echo $datos_alumno['grupo_id']; ?>" required>

            <div class="botones">
                <button type="submit" name="modificar">Modificar</button>
                <button type="button" onclick="window.location.href='../php/menuadmin.php'">Inicio</button>
                <button type="button" onclick="window.location.href='modificaralumno.php'">Cancelar</button>
            </div>
        <?php endif; ?>
    </form>
</div>
<script src="bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
