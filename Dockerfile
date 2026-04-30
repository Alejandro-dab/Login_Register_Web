# El archivo Docker le dice a Render que construya un entorno que use PHP 8.1 con Apache.
# Usa una imagen oficial de PHP con Apache
FROM php:8.1-apache 
# Solución al error de modulos duplicados en Railway
RUN a2dismod mpm_event && a2enmod mpm_prefork
# Instala las extensiones mysqli (para conectar a MySQL)
RUN docker-php-ext-install mysqli pdo pdo_mysql
 # Copia todo el código a la carpeta del servidor
COPY . /var/www/html
#Puerto estándar de web
EXPOSE 80 