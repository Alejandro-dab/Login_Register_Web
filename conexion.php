<?php // Conexión monolitica a la base de datos MYSQL usando PHP. En la API ya uso PDO, puedo usar ambas
// Inicia la sesión de PHP. Debe ser lo PRIMERO en ejecutarse antes de cualquier salida.
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
// Lee las variables de entorno que Railway crea automáticamente
$host = getenv('MYSQLHOST') ?: 'localhost';
$user = getenv('MYSQLUSER') ?: 'root';
$pass = getenv('MYSQLPASSWORD') ?: 'root';
$db   = getenv('MYSQLDATABASE') ?: 'Users';

$conexion = mysqli_connect($host, $user, $pass, $db);


//Si la variable conexion es falso (si la conexión falló)
if (!$conexion) {
    // Si falla, muestra por qué (ahora veremos un error real, no "localhost")
    die("Error al conectarse a la base de datos: " . mysqli_connect_error());
}
?>