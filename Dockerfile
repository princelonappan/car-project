FROM php:7.4-apache
RUN apt-get update && apt-get install -y \
    zlib1g-dev \
    libzip-dev \
    unzip
RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli
RUN mkdir -p /var/www/html/car-api-12/
WORKDIR /var/www/html/car-project/
COPY . /var/www/html/car-project/

RUN php -r "readfile('http://getcomposer.org/installer');" | php -- --install-dir=/usr/bin/ --filename=composer

RUN composer install