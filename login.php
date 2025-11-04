<?php
include("conexion.php"); // Incluye la conexión y, por lo tanto, session_start()
// Asegúrate de que solo procesamos formularios POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    //Recibir y limpiar datos
    $user_o_email = mysqli_real_escape_string($conexion, $_POST['user_o_email']); // Ajusta el nombre del input de tu formulario de login
    $pass_ingresada = $_POST['password']; // Ajusta el nombre del input de tu formulario de login

    //Buscar al usuario por nombre o email
    $query = "SELECT * FROM Usuarios WHERE nombre_user = '$user_o_email' OR email_user = '$user_o_email' LIMIT 1";
    $ejecutar = mysqli_query($conexion, $query);

    //Verificar si el usuario existe
    if (mysqli_num_rows($ejecutar) == 1) {
        $usuario = mysqli_fetch_assoc($ejecutar);
        $hash_guardado = $usuario['pass_user']; //Hash encriptado de la BD

        //Verificar la contraseña encriptada
        if (password_verify($pass_ingresada, $hash_guardado)) {
            
            //Iniciar sesión y guardar variables
            $_SESSION['autenticado'] = true;
            $_SESSION['user_id'] = $usuario['id_user']; // Asume que tienes un campo 'id_user'
            $_SESSION['nombre_user'] = $usuario['nombre_user'];
            $_SESSION['admin_user'] = $usuario['admin_user'];
            
            // Redireccion limpia: Usar header() y exit() en lugar de JavaScript para el éxito
            header("Location: index.php");
            exit();
            
        } else {
            // Error: Contraseña incorrecta
            echo '<script>
                alert("Usuario o contraseña incorrectos.");
                window.location = "login_register.php";
            </script>';
        }
    } else {
        // Error: Usuario no encontrado
        echo '<script>
            alert("Usuario o contraseña incorrectos.");
            window.location = "login_register.php";
        </script>';
    }

} else {
    // Si alguien intenta acceder directamente a este archivo, lo redirigimos
    header("Location: login_register.php");
    exit();
}
?>