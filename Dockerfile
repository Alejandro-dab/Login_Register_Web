FROM php:8.1-apache

# Instalamos extensiones necesarias para MySQL
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Solucionamos el conflicto de MPM en un solo paso atómico
RUN a2dismod mpm_event mpm_worker 2>/dev/null || true && \
    a2enmod mpm_prefork && \
    a2enmod rewrite

# Copiamos el código al directorio estándar de Apache
COPY . /var/www/html/

# Aseguramos que Apache sea el dueño de los archivos
RUN chown -R www-data:www-data /var/www/html

# Exponemos el puerto 80
EXPOSE 80

CMD ["apache2-foreground"]