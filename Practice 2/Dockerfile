FROM php:8.1-apache

RUN docker-php-ext-install mysqli

RUN apt update && apt install -y zlib1g-dev libpng-dev 

RUN docker-php-ext-install gd