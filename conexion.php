<!-- Conexión monolitica a la base de datos MYSQL usando PHP. En la API ya uso PDO, puedo usar ambas-->
<?php
// Inicia la sesión de PHP. Debe ser lo PRIMERO en ejecutarse antes de cualquier salida.
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
//Variable conexion enviar 4 argumentos a la función php mysqli_connect
$conexion = mysqli_connect("localhost", "root", "root", "Users");

//Si la variable conexion es falso (si la conexión falló)
if(!$conexion)
{
    // Detiene el script y muestra un error, evitando que $conexion se use como FALSE.
    die("Error al conectarse a la base de datos."); 
    // Para depuración: die("Error al conectarse a la base de datos: " . mysqli_connect_error());
}
?>