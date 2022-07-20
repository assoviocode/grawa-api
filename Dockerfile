FROM php:8.1-fpm

WORKDIR /var/www/html
COPY . /var/www/html

RUN apt-get update && apt-get install -y zlib1g-dev libzip-dev unzip
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin/ --filename=composer
RUN composer update --no-dev --no-interaction --no-plugins --no-scripts -o
RUN docker-php-ext-install pdo_mysql

CMD php -S 0.0.0.0:8080 -t public
EXPOSE 8080