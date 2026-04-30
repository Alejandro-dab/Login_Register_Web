FROM php:8.1-cli

# Instalar Apache manualmente (sin MPM preconfigurado)
RUN apt-get update && apt-get install -y \
    apache2 \
    libapache2-mod-php8.1 \
    && docker-php-ext-install mysqli pdo pdo_mysql \
    && rm -f /etc/apache2/mods-enabled/mpm_*.load \
             /etc/apache2/mods-enabled/mpm_*.conf \
    && a2enmod mpm_prefork php8.1 rewrite \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

COPY . /var/www/html/
RUN chown -R www-data:www-data /var/www/html

ENV APACHE_RUN_USER=www-data
ENV APACHE_RUN_GROUP=www-data
ENV APACHE_LOG_DIR=/var/log/apache2

EXPOSE 80
CMD ["apache2ctl", "-D", "FOREGROUND"]