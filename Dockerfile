FROM php:8.1-apache

# Instalamos extensiones necesarias para MySQL
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Desactivamos módulos conflictivos y configuramos el motor correcto
RUN a2dismod mpm_event || true && \
    rm -f /etc/apache2/mods-enabled/mpm_event.load /etc/apache2/mods-enabled/mpm_event.conf && \
    a2enmod mpm_prefork


# Desactivamos el módulo que causa el error y activamos el correcto
RUN a2dismod mpm_event || true && a2enmod mpm_prefork

# Copiamos el código al directorio estándar de Apache
COPY . /var/www/html/

# Aseguramos que Apache sea el dueño de los archivos (Buenas prácticas)
RUN chown -R www-data:www-data /var/www/html

# Exponemos el puerto 80
EXPOSE 80

# Comando para mantener Apache corriendo en primer plano
CMD ["apache2-foreground"]