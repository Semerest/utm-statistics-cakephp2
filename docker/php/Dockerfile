FROM php:5.6-fpm

RUN docker-php-ext-install mysql mysqli pdo pdo_mysql

RUN echo "date.timezone=Europe/Moscow" > /usr/local/etc/php/conf.d/timezone.ini

WORKDIR /var/www/app