<?php
session_start();
include('php/conexion.php');
$mensaje = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $correo = $_POST['correo'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM usuarios WHERE correo = '$correo' AND password = '$password' AND rol = 'alumno'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 1) {
        $usuario = mysqli_fetch_assoc($result);
        $_SESSION['correo'] = $usuario['correo'];
        $_SESSION['matricula'] = $usuario['matricula'];
        $_SESSION['rol'] = $usuario['rol'];
        header("Location: php/menu.php");
        exit();
    } else {
        $mensaje = "Acceso denegado. Verifique sus datos.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Login Alumno</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
</head>
<body class="bg-light d-flex justify-content-center align-items-center vh-100">
    <div class="card shadow" style="width: 22rem;">
        <div class="bg-success" style="height: 20px;"></div>
        <div class="card-body">
            <h5 class="card-title text-center text-success mb-4">ALUMNO</h5>
            <form method="POST">
                <div class="mb-3">
                    <label>Correo:</label>
                    <input type="email" name="correo" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Contraseña:</label>
                    <input type="password" name="password" class="form-control" required>
                </div>
                <div class="d-grid">
                    <button type="submit" class="btn btn-success">Ingresar</button>
                </div>
                <div class="d-grid mt-2">
                    <a href="index.php" class="btn btn-secondary">Cancelar</a>
                </div>
            </form>
            <?php if (!empty($mensaje)): ?>
                <div class="alert alert-danger mt-3"><?php echo $mensaje; ?></div>
            <?php endif; ?>
        </div>
        <div class="bg-success" style="height: 20px;"></div>
    </div>
</body>
</html>
