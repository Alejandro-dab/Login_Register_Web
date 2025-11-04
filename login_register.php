<!DOCTYPE html>
<html lang="es">
<head>
    <!-- Configuración de caracteres para admitir acentos y simbolos -->
    <meta charset="UTF-8">
    <!-- Configuración de la ventana grafica-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Meta description: Es el texto que aparece debajo del título en los resultados de búsqueda de Google.-->
    <meta name="description" content="Login_register">
    <!-- Creador de la pagina web -->
    <meta name="author" content="Alejandro Del Angel Bahena">

    <title>Login_register</title>
    <!-- Cargar Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- Restablecer propiedades de los atributos -->
    <link rel="stylesheet" href="assets/css/reset.css">
    <!-- Cargar fuentes necesarias, alto rendimiento -->
    <link rel="stylesheet" href="assets/css/all.min.css">
    <!-- Cargar estilos del login -->
    <link rel="stylesheet" href="assets/css/style_login.css">
    <!-- Importar libreria de iconos -->
    <script src="https://kit.fontawesome.com/1f5e771bdc.js" crossorigin="anonymous"></script>
</head>

<body>
    <!-- Sección de inicio de sesión o registro -->
    <div class="login-register">
        <!-- Iniciar sesión -->
        <div class="login" id="form__login">
            <form action="login.php" method="POST">
                <!-- Fieldset y legend por accesibilidad -->
                <fieldset>
                    <legend><h1>Iniciar sesión</h1></legend>
                    <!-- Agregar email o usuario -->
                    <div class="login__input">
                        <i class="fa-solid fa-envelope"></i>
                        <input type="text" placeholder="Correo o Usuario" id="login__email" name="user_o_email" required>
                    </div>
                    <div class="login__input">
                        <i class="fa-solid fa-lock"></i>
                        <input type="password" placeholder="Contraseña" id="login__password" name="password" required>
                    </div>
                    <!-- Boton iniciar sesión -->
                    <button class="login__submit" type="submit">Iniciar sesión</button>
                </fieldset>
            </form>
            <!-- Ir al Registro -->
            <span class="text">¿No tienes una cuenta?</span>
            <button id="register_btn--go" type="button">Registrar</button> 
                
        </div>
        <!-- Registro de usuario -->
        <div class="register oculto" id="form__register">
            <form action="registrar.php" method="POST">
                <fieldset>
                    <legend><h1>Registro de cuenta</h1></legend>
                    <!-- Registrar email -->
                    <div class="register__input">
                        <i class="fa-solid fa-envelope"></i>
                       <input type="email" placeholder="Correo electronico" id="register__email" name="email" required>
                    </div>
                    <!-- Registrar usuario -->
                    <div class="register__input">
                        <i class="fa-solid fa-user"></i>
                        <input type="text" placeholder="Usuario" id="register__user" name="user" required>
                    </div>
                    <!-- Registrar contraseña -->
                    <div class="register__input">
                        <i class="fa-solid fa-lock"></i>
                        <input type="password" placeholder="Contraseña" id="register__password" name="password_1" required>
                    </div>
                    <!-- Confirmar contraseña -->
                    <div class="register__input">
                        <i class="fa-solid fa-lock"></i>
                        <input type="password" placeholder="Repita contraseña" id="register__password-confirm" name="password_2" required>
                    </div>
                    <!-- Aceptar terminos y condiciones -->
                    <div class="register__terms">
                        <label class="terms__check">
                            <input type="checkbox" name="check__terms" class="checkbox" value="accepted" required>
                            <span class="text terms">Acepto términos y condiciones</span>
                        </label>
                    </div>
                    <!-- Crear cuenta -->
                    <button class="register__submit" type="submit">Crear cuenta</button>
                    
                </fieldset>
            </form>
            <!-- Ir a Login -->
            <span class="text">¿Tienes una cuenta?</span>
            <button id="login_btn--go" type="button">Iniciar sesión</button>
        </div>
    </div>

    <!-- Cargar funciones js -->
    <script src="assets/js/script_login.js"></script>
</body>