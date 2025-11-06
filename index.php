<?php
// Esto asume que la conexion.php ya tiene session_start()
include("conexion.php"); 

// Si la sesión no está autenticada, redirigir al login
if (!isset($_SESSION['autenticado']) || $_SESSION['autenticado'] !== true) {
    header("Location: login_register.php");
    exit();
}

//Variables de sesión
$nombre_usuario = $_SESSION['nombre_user'];
$es_admin = $_SESSION['admin_user'];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tarjeta</title>
    <!-- Resetear estilos del navegador -->
    <link rel="stylesheet" href="assets/css/reset.css">
    <!-- Estilos del login y el index -->
    <link rel="stylesheet" href="assets/css/style_login.css">
    <link rel="stylesheet" href="assets/css/styles.css">
</head>

<body>
    <!-- Contenedor de la tarjeta -->
    <div class="main-container"> <div class="profile-card">
        <div class="card-header">
            <h3>Tu Sesión es Correcta</h3>
            <!-- Mostrar el id y el rol -->
            <p>ID: <?php echo $_SESSION['user_id']; ?> | Rol: <?php echo ($es_admin == 1) ? 'Administrador' : 'Usuario Estándar'; ?></p>
        </div>

        <!-- Contenedor del perfil -->
        <div class="user-profile">
            <figure class="user-avatar-container">
                <img class="user-avatar" src="assets/img/Perfil.jpg" alt="Imagen del usuario">
            </figure>
            
            <div class="user-info">
            <!-- Mostrar el nombre del usuario -->
            <span class="info-name"><?php echo $_SESSION['nombre_user']; ?></span>
            <p class="info-city">Edo.Mex</p> 
        </div> 
        </div>

        <!-- Información random -->
        <div class="user-stats">
            <div class="stat-item">
                <p class="stat-number">15K</p>
                <p class="stat-label">Seguidores</p>
            </div>
            <div class="stat-item">
                <p class="stat-number">2K</p>
                <p class="stat-label">Posts</p>
            </div>
            <div class="stat-item">
                <p class="stat-number">125K</p>
                <p class="stat-label">Me gusta</p>
            </div>
        </div>
        
        <!-- Botón de cerrar sesión y redirección a logout.php -->
        <a href="logout.php" class="logout-btn">Cerrar Sesión</a>
    </div>

</div>
</body>
</html>