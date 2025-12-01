<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

//Variable DB_HOST de Railway
$DB_HOST_RAILWAY = getenv('DB_HOST');

if ($DB_HOST_RAILWAY) {
    //Variables de entorno de Railway
    $DB_HOST = $DB_HOST_RAILWAY;
    $DB_USER = getenv('DB_USER');
    $DB_PASS = getenv('DB_PASS');
    $DB_NAME = getenv('DB_NAME');
    $DB_PORT = (int)getenv('DB_PORT'); // Convertir a entero

} else {
    //Variables locales
    $DB_HOST = '127.0.0.1'; // O 'localhost'
    $DB_USER = 'root';      // Usuario local
    $DB_PASS = 'root';          // Contraseña local (si no tiene, déjala vacía)
    $DB_NAME = 'Users';     // DB local
    $DB_PORT = 3306;        // Puerto MySQL por defecto
}

//Conexión usando las variables correctas
$conexion = mysqli_connect($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME, $DB_PORT);

//Verificación de la conexión
if (!$conexion) {
    die("Error al conectarse a la base de datos: " . mysqli_connect_error());
}
?>