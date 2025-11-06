<!-- Conexión monolitica a la base de datos MYSQL usando PHP. En la API ya uso PDO, puedo usar ambas-->
<?php
// Inicia la sesión de PHP. Debe ser lo PRIMERO en ejecutarse antes de cualquier salida.
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
//Variable conexion enviar 4 argumentos a la función php mysqli_connect
// Render y cualquier host profesional pasan las claves por el entorno
/* La función  en PHP se utiliza para obtener el valor de una variable de entorno del sistema o del entorno de ejecución del servidor. 
Es clave para acceder a configuraciones sensibles como claves API, credenciales o rutas sin exponerlas directamente en el código.
*/
$DB_HOST = getenv('DB_HOST') ?: "localhost"; 
$DB_USER = getenv('DB_USER') ?: "root"; 
$DB_PASS = getenv('DB_PASS') ?: "root"; 
$DB_NAME = getenv('DB_NAME') ?: "Users"; 

$conexion = mysqli_connect($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);

//Si la variable conexion es falso (si la conexión falló)
if(!$conexion)
{
    // Detiene el script y muestra un error, evitando que $conexion se use como FALSE.
    die("Error al conectarse a la base de datos."); 
    // Para depuración: die("Error al conectarse a la base de datos: " . mysqli_connect_error());
}
?>