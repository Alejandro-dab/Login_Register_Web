<?php
include("conexion.php");

// Proceso la sesión si no está iniciada (aunque ya está en conexion.php, es buena práctica asegurarlo. Por si las moscas)
if (!isset($_SESSION)) {
    session_start();
}

//Procesar si el formulario fue enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    
    // Variables HTML -> PHP (Quitamos mysqli_real_escape_string, ya no es necesario con prepared statements)
    $user = $_POST['user'];
    $email = $_POST['email'];
    
    //Encriptamos la contraseña por seguridad y antes de guardarla en la base de datos. Se le dice hashear. 
    $pass_hash = password_hash($_POST['password_1'], PASSWORD_DEFAULT); 
    $pass_confirm = $_POST['password_2']; // Solo para la verificación inmediata
    $admin = 0;

    // strpos() Busca admin dentro del string $email
    // Usamos strtolower() para que la búsqueda no sea sensible a mayúsculas/minúsculas. Pasamos todo a minusculas.
    if(strpos(strtolower($email), 'admin') !== false){
        $admin = 1; //Asigna 1 si se encuentra admin en $email
    }

    // --- PRIMERO PREPARAMOS TODAS LAS CONSULTAS ---

    // 1. Prepara la consulta de INSERT
    $insertar = "INSERT INTO Usuarios (nombre_user, email_user, pass_user, admin_user) VALUES (?, ?, ?, ?)";
    $stmt_insert = mysqli_prepare($conexion, $insertar);
    // Vincula variables al INSERT
    mysqli_stmt_bind_param($stmt_insert, "sssi", $user, $email, $pass_hash, $admin);
    
    // 2. Prepara la consulta de verificar USUARIO
    $sql_user = "SELECT * FROM Usuarios WHERE nombre_user = ?";
    $stmt_user = mysqli_prepare($conexion, $sql_user);
    mysqli_stmt_bind_param($stmt_user, "s", $user);

    // 3. Prepara la consulta de verificar CORREO
    $sql_email = "SELECT * FROM Usuarios WHERE email_user = ?";
    $stmt_email = mysqli_prepare($conexion, $sql_email);
    mysqli_stmt_bind_param($stmt_email, "s", $email);


    // --- AHORA EJECUTAMOS Y VALIDAMOS ---

    // Ejecuta y obtén resultados de USUARIO
    mysqli_stmt_execute($stmt_user);
    $verificar_usuario = mysqli_stmt_get_result($stmt_user); // <-- CAMBIO: Movido aquí

    // Ejecuta y obtén resultados de CORREO
    mysqli_stmt_execute($stmt_email);
    $verificar_correo = mysqli_stmt_get_result($stmt_email); // <-- CAMBIO: Movido aquí

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
        //Ejecuta la consulta preparada
        $agregar = mysqli_stmt_execute($stmt_insert);
        
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
            // Solución: Usamos JavaScript para la alerta Y la redirección
            echo '<script>
                    alert("' . $mensaje . '");
                    window.location.href = "index.php";
                </script>';
            exit();
        }
        else {
            //Fallo en la inserción a la base de datos
            echo '<script>
            alert("Error al intentar agregar usuario: '.mysqli_error($conexion).'");
            </Sscript>';
            
            // El die() detiene el script de PHP, por lo que no hace falta
            // usar window.location aquí, evitando el "parpadeo" de la redirección.
            die(); 
        }
    }

    // Cerramos los statements para limpiar la conexión
    mysqli_stmt_close($stmt_insert);
    mysqli_stmt_close($stmt_user);
    mysqli_stmt_close($stmt_email);
}
?>