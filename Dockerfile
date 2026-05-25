FROM php:8.2-apache
RUN a2dismod mpm_event && a2enmod mpm_prefork
RUN docker-php-ext-install pdo pdo_mysql
COPY . /var/www/html/
RUN chmod 644 /var/www/html/*.php
