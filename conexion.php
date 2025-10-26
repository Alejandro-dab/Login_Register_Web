<!-- Conexión monolitica a la base de datos MYSQL usando PHP. En la API ya uso PDO, puedo usar ambas-->
<?php
//Variable conexion enviar 4 argumentos a la función php mysqli_connect
$conexion = mysqli_connect("localhost", "root", "root", "H_Games");

//Si la variable conexion es falso
if(!$conexion)
{
    //Termina la ejecución del script y muestra el mensaje de error
    die("Error al conectarse a la base de datos");
    // die("Fallo en la conexión: " . mysqli_connect_error());
}
?>