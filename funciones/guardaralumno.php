<?php
session_start();

if (!isset($_SESSION['correo'])) {
    header("Location: ../principal.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $matricula = $_POST['matricula'];
    $nombre = $_POST['nombre'];
    $ap_paterno = $_POST['ap_paterno'];
    $ap_materno = $_POST['ap_materno'];
    $edad = $_POST['edad'];
    $fecha_nacimiento = $_POST['fecha_nacimiento'];
    $sexo = $_POST['sexo'];
    $grupo_id = $_POST['grupo_id'];

    // Verificar si el grupo_id existe en la tabla grupos
    $checkGrupoQuery = "SELECT id FROM grupos WHERE id = '$grupo_id'";
    $checkResult = mysqli_query($conn, $checkGrupoQuery);

    if (mysqli_num_rows($checkResult) == 0) {
        $mensaje = "El grupo seleccionado no existe.";
        $exito = false;
    } else {
        // Insertar en la tabla alumnos
    $query = "INSERT INTO alumnos (matricula, nombre, ap_paterno, ap_materno, edad, fecha_nacimiento, sexo, grupo_id) 
          VALUES ('$matricula', '$nombre', '$ap_paterno', '$ap_materno', '$edad', '$fecha_nacimiento', '$sexo', '$grupo_id')";

        if (mysqli_query($conn, $query)) {
            // Generar correo y contraseña
            $correo = strtolower($nombre) . "." . strtolower($ap_paterno) . "@conalepmorelos173.edu.mx";
            $password = strtolower($nombre) . "1234";
            $rol = "alumno";

            // Insertar en la tabla usuarios
            $queryUsuario = "INSERT INTO usuarios (correo, password, rol, matricula) 
                             VALUES ('$correo', '$password', '$rol', '$matricula')";

            if (mysqli_query($conn, $queryUsuario)) {
                $mensaje = "Alumno registrado correctamente.<br>Correo: $correo<br>Contraseña: $password";
                $exito = true;
            } else {
                $mensaje = "Alumno registrado, pero error al crear el usuario: " . mysqli_error($conn);
                $exito = false;
            }
        } else {
            $mensaje = "Error al registrar al alumno: " . mysqli_error($conn);
            $exito = false;
        }
    }

    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro de Alumno</title>
      <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f1f1f1;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .mensaje {
            background-color: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            text-align: center;
        }
        .mensaje h2 {
            color: <?php echo $exito ? '#2e7d32' : '#c62828'; ?>;
        }
    </style>
    <meta http-equiv="refresh" content="6;url=registraralumno.php">
</head>
<body>
    <div class="mensaje">
        <h2><?php echo $mensaje; ?></h2>
        <p>Serás redirigido en unos segundos...</p>
    </div>
    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
