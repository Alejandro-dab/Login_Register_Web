FROM php:8.1-apache

# Instalamos extensiones necesarias para MySQL
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Eliminamos TODOS los MPM y dejamos solo prefork
RUN apt-get update && \
    apt-get install -y libapache2-mod-php8.1 2>/dev/null || true && \
    # Desactivar todos los MPM posibles
    a2dismod mpm_event mpm_worker mpm_prefork 2>/dev/null || true && \
    # Limpiar manualmente cualquier archivo MPM que quedó
    rm -f /etc/apache2/mods-enabled/mpm_*.load \
          /etc/apache2/mods-enabled/mpm_*.conf && \
    # Activar solo prefork
    a2enmod mpm_prefork && \
    a2enmod rewrite

COPY . /var/www/html/

RUN chown -R www-data:www-data /var/www/html

EXPOSE 80

CMD ["apache2-foreground"]