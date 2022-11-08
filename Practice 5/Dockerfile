FROM php:apache

RUN docker-php-ext-install mysqli

RUN a2enmod authn_dbd

RUN apt-get update && apt-get install -y libaprutil1-dbd-mysql && apt-get install -y git

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN pecl install -o -f redis && rm -rf /tmp/pear && docker-php-ext-enable redis

RUN RUN mkdir /var/www/storage && chown -R www-data:www-data /var/www/storage

WORKDIR /var/www/ 
RUN composer require webonyx/graphql-php