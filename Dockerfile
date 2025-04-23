FROM php:8.2-apache

#INSTALL PHP EXTENSIONS
RUN docker-php-ext-install mysqli pdo pdo_mysql

#ENABLE APACHE MOD_REWRITE
RUN a2enmod rewrite 

#OPTIONAL: Custom Apache Config
COPY .docker/apache.conf /etc/apache2/sites-available/000-default.conf

#SET WORKING DIRECTORY
WORKDIR /var/www/html

