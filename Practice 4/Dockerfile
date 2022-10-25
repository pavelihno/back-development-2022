FROM php:apache

RUN docker-php-ext-install mysqli

RUN a2enmod authn_dbd

RUN apt-get update && apt-get install -y libaprutil1-dbd-mysql && apt-get install -y git

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /var/www/ 
RUN composer require webonyx/graphql-php