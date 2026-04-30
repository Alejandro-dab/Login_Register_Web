FROM php:8.1-apache

RUN docker-php-ext-install mysqli pdo pdo_mysql

# Hacer que Apache escuche en el puerto que Railway asigne
CMD ["/bin/sh", "-c", \
    "rm -f /etc/apache2/mods-enabled/mpm_*.load /etc/apache2/mods-enabled/mpm_*.conf && \
    ln -sf /etc/apache2/mods-available/mpm_prefork.load /etc/apache2/mods-enabled/mpm_prefork.load && \
    ln -sf /etc/apache2/mods-available/mpm_prefork.conf /etc/apache2/mods-enabled/mpm_prefork.conf && \
    sed -i \"s/Listen 80/Listen ${PORT:-80}/\" /etc/apache2/ports.conf && \
    sed -i \"s/:80>/:${PORT:-80}>/\" /etc/apache2/sites-enabled/000-default.conf && \
    apache2-foreground"]