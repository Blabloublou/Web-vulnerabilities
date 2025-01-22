FROM php:7.4-apache

COPY . /var/www/html/

RUN docker-php-ext-install mysqli

COPY icons /var/www/html/icons

RUN ln -s /var/www/html/icons /usr/local/apache2/htdocs/icons

EXPOSE 80