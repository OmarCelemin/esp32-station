FROM ubuntu:22.04

ENV DEBIAN_FRONTEND=noninteractive

RUN apt-get update && apt-get install -y \
    apache2 \
    php8.1 \
    php8.1-mysql \
    libapache2-mod-php8.1 \
    && a2enmod php8.1 \
    && rm -rf /var/lib/apt/lists/*

# Eliminar página por defecto
RUN rm -f /var/www/html/index.html

COPY . /var/www/html/
RUN chmod 644 /var/www/html/*.php

EXPOSE 80

CMD ["apache2ctl", "-D", "FOREGROUND"]
