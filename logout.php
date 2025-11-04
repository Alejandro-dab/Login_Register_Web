<?php
//Iniciar o reanudar la sesión para poder manipularla
session_start();

//Borrar todas las variables de sesión del array global
$_SESSION = array();

//Invalidar la cookie de sesión del navegador
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

//Destruir la sesión en el servidor
session_destroy();

//Redireccionar al usuario a la página de login/registro
header("Location: login_register.php");
exit();
?>