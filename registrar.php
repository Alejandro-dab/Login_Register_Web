<?php
include("conexion.php");

// Proceso la sesión si no está iniciada (aunque ya está en conexion.php, es buena práctica asegurarlo. Por si las moscas)
if (!isset($_SESSION)) {
    session_start();
}

//Procesar si el formulario fue enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    
    // Variables HTML -> PHP
    $user = mysqli_real_escape_string($conexion, $_POST['user']);
    $email = mysqli_real_escape_string($conexion, $_POST['email']);
    //Encriptamos la contraseña por seguridad y antes de guardarla en la base de datos. Se le dice hashear. 
    $pass_hash = password_hash($_POST['password_1'], PASSWORD_DEFAULT); 
    $pass_confirm = $_POST['password_2']; // Solo para la verificación inmediata
    $admin = 0;

    // strpos() Busca admin dentro del string $email
    // Usamos strtolower() para que la búsqueda no sea sensible a mayúsculas/minúsculas. Pasamos todo a minusculas.
    if(strpos(strtolower($email), 'admin') !== false){
        $admin = 1; //Asigna 1 si se encuentra admin en $email
    }

    //Valores de las variables PHP en MYSQL
    $insertar = "INSERT INTO Usuarios (nombre_user, email_user, pass_user, admin_user) VALUES ('$user', '$email', '$pass_hash', '$admin')";

    //Verificar usuario existente
    $verificar_usuario = mysqli_query($conexion, "SELECT * FROM Usuarios WHERE nombre_user = '$user'");
    //Verificar correo existente
    $verificar_correo = mysqli_query($conexion, "SELECT * FROM Usuarios WHERE email_user='$email'");

    // Verificamos que las contraseñas sean las mismas (PRIORIDAD)
    if($_POST['password_1'] != $pass_confirm) // Si password_1 no es igual a password_2
    {
        echo '<script>
            alert("Las contraseñas no coinciden");
            window.location = "login_register.php";
        </script>';
    } 
    // Verificamos que no se repita el email en la base de datos. 
    elseif(mysqli_num_rows($verificar_correo) > 0)
    {
        echo '<script>
            alert("Este correo ya está en uso");
            window.location = "login_register.php";
        </script>';
    }
    // Verificamos que el usuario no se repita
    elseif(mysqli_num_rows($verificar_usuario) > 0)
    {
        echo '<script>
            alert("Este usuario ya está en uso");
            window.location = "login_register.php";
        </script>';
    }    
    else 
    {
        //Si las validaciones fueron exitosas ejecutamos el insert
        $agregar = mysqli_query($conexion, $insertar);
        
        if($agregar)
        {
            //Obtener el ID del usuario recién insertado
            $user_id = mysqli_insert_id($conexion);
            
            //Establecer variables de sesión (SE EJECUTA SIEMPRE)
            $_SESSION['autenticado'] = true;
            $_SESSION['user_id'] = $user_id;
            $_SESSION['nombre_user'] = $user;
            $_SESSION['admin_user'] = $admin;

            //Redirección final
            $mensaje = ($admin == 1) ? "Usuario administrador agregado" : "Usuario agregado";
            
            // Usamos la redirección más limpia con header()
            echo '<script>alert("' . $mensaje . '"); </script>'; 
            header("Location: index.php"); 
            exit();
        }
        else {
            //Fallo en la inserción a la base de datos
            echo '<script>
            alert("Error al intentar agregar usuario: '.mysqli_error($conexion).'");
            </script>';
            
            // El die() detiene el script de PHP, por lo que no hace falta
            // usar window.location aquí, evitando el "parpadeo" de la redirección.
            die(); 
        }
    }
}
?>