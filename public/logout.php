<?php
// 1. Iniciar la sesión para poder acceder a ella
session_start();

// 2. Vaciar el array de la sesión en memoria
$_SESSION = [];

// 3. Destruir la sesión en el servidor
session_destroy();

// 4. Redirigir al usuario de vuelta al login y cortar ejecución
header("Location: login.php");
exit;
?>