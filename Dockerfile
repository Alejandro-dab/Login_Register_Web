FROM php:8.1-apache

# Forzar ambiente limpio
ENV APACHE_CONFDIR=/etc/apache2

# Extensiones MySQL
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Reemplazar COMPLETAMENTE la configuración de MPM
RUN rm -f /etc/apache2/mods-enabled/mpm_*.load \
          /etc/apache2/mods-enabled/mpm_*.conf \
          /etc/apache2/mods-available/mpm_event.conf \
          /etc/apache2/mods-available/mpm_worker.conf && \
    ln -sf /etc/apache2/mods-available/mpm_prefork.load \
           /etc/apache2/mods-enabled/mpm_prefork.load && \
    ln -sf /etc/apache2/mods-available/mpm_prefork.conf \
           /etc/apache2/mods-enabled/mpm_prefork.conf

COPY . /var/www/html/
RUN chown -R www-data:www-data /var/www/html

EXPOSE 80
CMD ["apache2-foreground"]