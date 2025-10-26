<?php
include("conexion.php");

//Procesar si el formulario fue enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    
    // Variables HTML -> PHP
    $user = mysqli_real_escape_string($conexion, $_POST['user']);
    $email = mysqli_real_escape_string($conexion, $_POST['email']);
    $pass = $_POST['password_1'];
    // 🔑 CORRECCIÓN CRÍTICA: Usar el nombre del input 'password_2'
    $pass_confirm = $_POST['password_2']; 
    $admin = 0;

    // strpos() Busca admin dentro del string $email
    // Usamos strtolower() para que la búsqueda no sea sensible a mayúsculas/minúsculas. Pasamos todo a minusculas.
    if(strpos(strtolower($email), 'admin') !== false){
        $admin = 1; //Asigna 1 si se encuentra admin en $email
    }

    //Valores de las variables PHP en MYSQL
    $insertar = "INSERT INTO Usuarios (nombre_user, email_user, pass_user, admin_user) VALUES ('$user', '$email', '$pass', '$admin')";

    //Verificar usuario existente
    $verificar_usuario = mysqli_query($conexion, "SELECT * FROM Usuarios WHERE nombre_user = '$user'");
    //Verificar correo existente
    $verificar_correo = mysqli_query($conexion, "SELECT * FROM Usuarios WHERE email_user='$email'");

    // Verificamos que las contraseñas sean las mismas (PRIORIDAD)
    if($pass != $pass_confirm) // Usamos != para una lógica más clara
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
        // 🔑 EJECUCIÓN DEL INSERT (Solo si todas las validaciones son exitosas)
        $agregar = mysqli_query($conexion, $insertar);
        
        if($agregar)
        {
            if($admin == 1){
                $pagina = "api/control_admin.php";
                $mensaje = "Usuario administrador agregado";
            }
            else{
                $pagina = "login_register.php";
                $mensaje = "Usuario agregado";
            }
            echo '<script>
                alert("' . $mensaje . '"); 
                window.location = "' . $pagina . '";
            </script>';
        } else {
            // ESTE BLOQUE SOLO SE EJECUTA SI LA INSERCIÓN FALLA
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