<?php
include("conexion.php"); // Incluye la conexión y, por lo tanto, session_start()

// Asegúrate de que solo procesamos formularios POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    // 1. Recibir datos (ya no necesitamos mysqli_real_escape_string)
    $user_o_email = $_POST['user_o_email']; 
    $pass_ingresada = $_POST['password']; 

    // 2. PREPARAR LA CONSULTA (¡SEGURA!)
    // Usamos marcadores de posición (?) para evitar Inyección SQL
    $query = "SELECT * FROM Usuarios WHERE nombre_user = ? OR email_user = ? LIMIT 1";
    $stmt = mysqli_prepare($conexion, $query);

    // 3. VINCULAR LAS VARIABLES
    // "ss" significa que estamos vinculando dos (s)trings
    // Vinculamos la *misma* variable $user_o_email a los dos marcadores (?)
    mysqli_stmt_bind_param($stmt, "ss", $user_o_email, $user_o_email);
    
    // 4. EJECUTAR
    mysqli_stmt_execute($stmt);

    // 5. OBTENER EL RESULTADO
    $ejecutar = mysqli_stmt_get_result($stmt);

    //Verificar si el usuario existe
    if (mysqli_num_rows($ejecutar) == 1) {
        $usuario = mysqli_fetch_assoc($ejecutar);
        $hash_guardado = $usuario['pass_user']; //Hash encriptado de la BD

        //Verificar la contraseña encriptada (ESTO YA ESTABA PERFECTO)
        if (password_verify($pass_ingresada, $hash_guardado)) {
            
            //Iniciar sesión y guardar variables
            $_SESSION['autenticado'] = true;
            $_SESSION['user_id'] = $usuario['id_user'];
            $_SESSION['nombre_user'] = $usuario['nombre_user'];
            $_SESSION['admin_user'] = $usuario['admin_user'];
            
            // Redireccion limpia
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