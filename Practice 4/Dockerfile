FROM php:apache

RUN docker-php-ext-install mysqli

RUN a2enmod authn_dbd

RUN apt-get update && apt-get install -y libaprutil1-dbd-mysql