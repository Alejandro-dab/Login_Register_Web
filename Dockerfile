FROM php:8.1-apache

# Extensiones MySQL
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Limpiar TODOS los MPM completamente y dejar solo prefork
RUN set -e && \
    # Deshabilitar todo
    a2dismod mpm_event mpm_worker mpm_prefork 2>/dev/null || true && \
    # Borrar manualmente todos los symlinks de MPM
    rm -f /etc/apache2/mods-enabled/mpm_*.load && \
    rm -f /etc/apache2/mods-enabled/mpm_*.conf && \
    # Verificar que no quede nada de MPM
    ls /etc/apache2/mods-enabled/ && \
    # Activar solo prefork desde cero
    ln -s /etc/apache2/mods-available/mpm_prefork.load /etc/apache2/mods-enabled/mpm_prefork.load && \
    ln -s /etc/apache2/mods-available/mpm_prefork.conf /etc/apache2/mods-enabled/mpm_prefork.conf

# Copiar archivos
COPY . /var/www/html/

RUN chown -R www-data:www-data /var/www/html

EXPOSE 80

CMD ["apache2-foreground"]