<?php
<?php
session_start();

if (!isset($_SESSION['correo'])) {
    header("Location: ../principal.php");
    exit();
}

$correo = $_SESSION['correo'];
include("conexion.php");

// Obtener matrícula del usuario
$query_matricula = "SELECT matricula FROM usuarios WHERE correo = '$correo'";
$resultado_matricula = mysqli_query($conn, $query_matricula);
$usuario = mysqli_fetch_assoc($resultado_matricula);
$matricula = $usuario['matricula'];

// Obtener historial de justificantes
$query_justificantes = "SELECT j.fecha, m.descripcion AS motivo, j.descripcion
                        FROM justificantes j
                        JOIN motivos m ON j.motivo_id = m.id
                        WHERE j.matricula = '$matricula'
                        ORDER BY j.fecha DESC";
$resultado_justificantes = mysqli_query($conn, $query_justificantes);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Historial de Justificantes</title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f1f1f1;
            padding: 40px;
        }

        h1 {
            color: #2e7d32;
            text-align: center;
        }

        .tabla-container {
            background-color: white;
            border-radius: 8px;
            padding: 20px;
            margin-top: 20px;
            box-shadow: 0 0 8px rgba(0,0,0,0.1);
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            background-color: #2e7d32;
            color: white;
            padding: 10px;
        }

        td {
            padding: 10px;
            border-bottom: 1px solid #ccc;
        }

        .regresar {
            display: block;
            margin-top: 20px;
            text-align: center;
        }

        .regresar a {
            text-decoration: none;
            color: white;
            background-color: #2e7d32;
            padding: 10px 20px;
            border-radius: 5px;
            font-weight: bold;
            transition: background-color 0.3s;
        }

        .regresar a:hover {
            background-color: #1b5e20;
        }
    </style>
</head>
<body>

<h1>Historial de Justificantes</h1>

<div class="tabla-container">
    <table>
        <tr>
            <th>Fecha</th>
            <th>Motivo</th>
            <th>Descripción</th>
        </tr>
        <?php while ($fila = mysqli_fetch_assoc($resultado_justificantes)): ?>
            <tr>
                <td><?php echo $fila['fecha']; ?></td>
                <td><?php echo $fila['motivo']; ?></td>
                <td><?php echo $fila['descripcion']; ?></td>
            </tr>
        <?php endwhile; ?>
    </table>
</div>

<div class="regresar">
    <a href="menu.php">← Regresar al menú</a>
</div>
<script src="bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
