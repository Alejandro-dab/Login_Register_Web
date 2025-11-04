# 🔑 Sistema de Autenticación (Login & Registro)

Este proyecto implementa un sistema completo y funcional de **Autenticación (Login y Registro)** para la gestión de usuarios. 
Fue desarrollado con una doble prioridad: establecer una base de datos de usuarios segura y proporcionar una **interfaz de usuario limpia, moderna y visualmente atractiva**.

## ✨ Características Esenciales
* Diseño Limpio y Atractivo (Frontend): Fuerte enfoque en la estética. La interfaz de Login y Registro está diseñada para ser minimalista, profesional y responsiva, utilizando fondos dinámicos y estilos de tarjeta modernos.
* Autenticación PHP/MySQL: Utiliza PHP como lenguaje de servidor para manejar la lógica de registro, login con la base de datos MySQL.
* Integridad de la Sesión (Cierre de Ciclo):** El sistema implementa las cuatro operaciones esenciales para el manejo del estado del usuario: **Registro**, **Inicio de Sesión**, **Verificación de Sesión** y **Cierre de Sesión (Logout)**.
* Manejo de Conexión: Implementación del script `conexion.php` para establecer la conexión a la base de datos de manera modular y manejar errores críticos de conexión con la función `die()`.
* Interfaz de Usuario Funcional: El frontend proporciona formularios claros y responsivos para las operaciones de registro y login.
* Gestión Segura de la Sesión (PHP):** Utiliza `session_start()`, `$_SESSION`, y el script `logout.php` con `session_destroy()` para garantizar la invalidación completa y segura del estado del usuario en el servidor, protegiendo contra secuestros de sesión básicos.
* Hashing de Contraseñas (Bcrypt):** Las contraseñas se almacenan de forma segura utilizando la función nativa `password_hash()` (algoritmo Bcrypt), y se verifican mediante `password_verify()`, eliminando el riesgo de exposición de contraseñas en texto plano.
* Validación Estricta de Campos:** Se realizan múltiples verificaciones en el servidor (`registrar.php`) para prevenir la duplicidad de nombre de usuario y correo electrónico, además de asegurar la coincidencia de contraseñas.
* Manejo de Errores:** Estructura `if/else` en PHP para diagnosticar fallos de conexión a la base de datos de forma explícita.
* Modularidad y Escalabilidad:** El proyecto separa las responsabilidades críticas en archivos dedicados (`conexion.php`, `login.php`, `registrar.php`), facilitando la depuración y la futura migración a **PDO** o arquitecturas MVC.

---

## 🛠️ Tecnologías Utilizadas
### Frontend:
* HTML5 y CSS3: Fundamentos de la estructura y estilos.
* Bootstrap 5: Utilizado exclusivamente como base para la responsividad y normalización, con estilos fuertemente sobrescritos para mantener el diseño neón personalizado.
* Font Awesome (Kit CDN):** Integración de iconos de alta calidad.

## Backend y Base de Datos:
* PHP: Lógica principal, control de flujo y autenticación.
* MySQLy: Extensión para la interacción con la base de datos MYSQL.
* MySQL: Almacenamiento de registros de usuario.

## Entorno de Desarrollo:
* XAMPP / WAMP / MAMP:  Entorno de desarrollo local esencial para PHP/MySQL.
* Git & GitHub: Control de versiones.

---

## 🚀 Instalación y Puesta en Marcha
### Requisitos:
* Un entorno de servidor local con PHP y MySQL en ejecución.

### Pasos:
1. Clonar el Repositorio
Clona el proyecto dentro de tu directorio de trabajo del servidor local (ej. `htdocs`). Asegúrate de que el directorio del proyecto se llame Login_basic.
git clone [(https://github.com/Alejandro-dab/Login_Register_Web.git)] auth-flow-project

3. Crea la base de datos con el script Users.sql.}
Ejecuta el script **`database/Users.sql`** para crear la tabla de usuarios (`Usuarios`) necesaria para el sistema.

4. Ajustar conexion.php: Abre el archivo conexion.php y confirma que las credenciales (especialmente el nombre de la BD, usuario y contraseña) coinciden con tu configuración de MySQL.

5. Inicia los servicios **Apache** y **MySQL**.

6. Entrar a la siguiente ruta en el navegador: [(http://localhost/Login_basic/login_register.php)]

