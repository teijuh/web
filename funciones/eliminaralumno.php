<?php
session_start();

if (!isset($_SESSION['correo'])) {
    header("Location: ../principal.php");
    exit();
}
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
    } elseif (isset($_POST['eliminar'])) {
        $matricula = $_POST['matricula'];

        // Eliminar justificantes relacionados
        mysqli_query($conn, "DELETE FROM justificantes WHERE matricula = '$matricula'");

        // Eliminar correo en la tabla usuarios
        mysqli_query($conn, "DELETE FROM usuarios WHERE matricula = '$matricula'");

        // Eliminar alumno
        $delete_alumno = "DELETE FROM alumnos WHERE matricula = '$matricula'";
        if (mysqli_query($conn, $delete_alumno)) {
            $mensaje = "Alumno, justificantes y correo eliminados correctamente.";
            $datos_alumno = null;
        } else {
            $mensaje = "Error al eliminar: " . mysqli_error($conn);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Eliminar Alumno</title>
   
      <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
</head>
<body class="bg-light">

<div class="container d-flex justify-content-center align-items-center min-vh-100">
    <div class="card shadow p-4" style="max-width: 500px; width: 100%;">
        <h4 class="text-center text-warning mb-3">Eliminar Alumno</h4>

        <?php if ($mensaje): ?>
            <div class="alert alert-info text-center"><?php echo $mensaje; ?></div>
        <?php endif; ?>

        <form method="POST">
            <?php if (!$datos_alumno): ?>
                <div class="mb-3">
                    <label for="matricula" class="form-label">Ingresa matrícula a eliminar:</label>
                    <input type="text" class="form-control" name="matricula" required>
                </div>
                <div class="d-grid">
                    <button type="submit" name="buscar" class="btn btn-success">Buscar</button>
                </div>
            <?php else: ?>
                <p class="fw-bold">Nombre: 
                    <span class="text-primary"><?php echo $datos_alumno['nombre'] . ' ' . $datos_alumno['ap_paterno'] . ' ' . $datos_alumno['ap_materno']; ?></span>
                </p>
                <input type="hidden" name="matricula" value="<?php echo $datos_alumno['matricula']; ?>">

                <div class="d-flex gap-2">
                    <button type="submit" name="eliminar" class="btn btn-danger w-50">Eliminar</button>
                    <button type="button" class="btn btn-secondary w-50" onclick="window.location.href='../php/menuadmin.php'">Cancelar</button>
                </div>
            <?php endif; ?>
        </form>
    </div>
</div>

<script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
