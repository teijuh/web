<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "justificantes"; // Asegúrate que este sea el nombre correcto de tu base de datos

$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn) {
    die("Error de conexión: " . mysqli_connect_error());
}
?>
