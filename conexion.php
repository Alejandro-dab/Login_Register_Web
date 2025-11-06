<?php // Conexión monolitica a la base de datos MYSQL usando PHP. En la API ya uso PDO, puedo usar ambas
// Inicia la sesión de PHP. Debe ser lo PRIMERO en ejecutarse antes de cualquier salida.
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
// Railway nos da estas variables.
// Leemos las variables de entorno que vamos a crear en el panel de Railway
$DB_HOST = getenv('DB_HOST');
$DB_USER = getenv('DB_USER');
$DB_PASS = getenv('DB_PASS');
$DB_NAME = getenv('DB_NAME');
$DB_PORT = getenv('DB_PORT'); // Railway necesita el puerto

// Convertir puerto a entero
$DB_PORT_INT = (int)$DB_PORT;

// Usamos las 5 variables para conectar
$conexion = mysqli_connect($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME, $DB_PORT_INT);

//Si la variable conexion es falso (si la conexión falló)
if (!$conexion) {
    // Si falla, muestra por qué (ahora veremos un error real, no "localhost")
    die("Error al conectarse a la base de datos: " . mysqli_connect_error());
}
?>