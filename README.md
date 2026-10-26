### 📌 **Paso 1: Crear los datos de prueba (** **src/datos.php** **)**

* **¿Por qué primero?** Porque antes de hacer un formulario de login, necesitas tener un usuario y una contraseña guardados en algún sitio contra los que poder comparar.
* **¿Qué haces aquí?** Creas un archivo simple con un array que tenga el usuario y su contraseña cifrada con `password_hash()`:

<?php
$usuarioValido = 'admin';
$hashValido = password_hash('1234', PASSWORD_DEFAULT);

### 📌 **Paso 2: Crear el formulario HTML (** **public/login.php** **)**

* **¿Por qué segundo?** Porque es la pantalla que ve el usuario. Si lo primero que haces en el examen es este archivo y abres el navegador, ya verás algo funcionando en pantalla y te quitarás los nervios.
* **¿Qué haces aquí?** Escribes el HTML del formulario con su `method="POST"`, sus dos `` y el `


<form action="login.php" method="POST">
    <input type="text" name="usuario" placeholder="Usuario">
    <input type="password" name="clave" placeholder="Contraseña">
    <button type="submit">Entrar</button>
</form>

### 📌 **Paso 3: Procesar el formulario arriba del HTML (** **public/login.php** **)**

* **¿Por qué tercero?** Ahora que tienes datos (Paso 1) y pantalla (Paso 2), los conectas.
* **¿Qué haces aquí?** Justo arriba del HTML en `login.php`, pones el `if` para recibir los datos, comparar la contraseña y abrir la sesión:

<?php
require_once __DIR__ . '/../src/datos.php';

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

### 📌 **Paso 4 (Para rematar el aprobado): La página protegida (** **public/panel.php** **)**

Solo te queda crear la página a la que llega el usuario tras loguearse, comprobando que no se pueda entrar sin sesión:

<?php 
session_start();
if (!isset($\_SESSION['usuario'])) {
  header("Location: login.php");
  exit;
}
?>
<h1>Bienvenido <? htmlspecialchars($_SESSION['usuario']) ?></h1>

### 📌 **Paso 5: Cerrar Sesión (** **public/logout.php** **)**

El archivo se crea dentro de la carpeta `public/` y requiere exactamente estas 4 instrucciones en orden:

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