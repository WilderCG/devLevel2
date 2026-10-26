<?php
declare(stric_types = 1);
require_one__DIR__ . '/../src/datos.php';
if (isset($_POST['usuario'])) {
  $usuario = trim($_POST['usuario'] ?? '');
  $clave = trim($_POST['clave'] ?? '');
   if ($usuario === $usuarioValido && password_verify($clave, $hashValido)) {
        session_start();
        $_SESSION['usuario'] = $usuario;
        header("Location: panel.php");
        exit;
    }
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Login Exámen</title>
</head>
<body>
  <h1>Login</h1>
  <form action="login.php" method = "POST">
    <label>Usuario: </label>
    <input type="text" name="usuario">

    <label>Contraseña: </label>
    <input type="password" name="clave">

    <button type="submit">Entrar</button>
  </form>
</body>
</html>

