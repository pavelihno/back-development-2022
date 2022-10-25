FROM php:apache

RUN docker-php-ext-install mysqli

RUN a2enmod authn_dbd

RUN apt-get update && apt-get install -y libaprutil1-dbd-mysql && apt-get install git

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN cd /var/www/html && composer require webonyx/graphql-php