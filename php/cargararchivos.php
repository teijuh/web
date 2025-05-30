<?php
session_start();

// Validamos que el usuario haya iniciado sesión
if (!isset($_SESSION['correo'])) {
    echo "Usuario no autenticado.";
    exit();
}

$correo = $_SESSION['correo'];

if (isset($_FILES['fotoperfil'])) {
    $archivo = $_FILES['fotoperfil']['tmp_name'];
    $destino = "../img/perfil/" . $correo . ".jpg"; // usamos ../ porque img está fuera de /php/

    // Si no existe la carpeta, la creamos
    if (!is_dir("../img/perfil/")) {
        mkdir("../img/perfil/", 0777, true);
    }

    if (move_uploaded_file($archivo, $destino)) {
        echo "Foto cargada correctamente. <a href='menuadmin.php'>Volver al menú</a>";
    } else {
        echo "❌ Error al subir la foto.";
    }
} else {
    echo "No se recibió ninguna imagen.";
}
?>

