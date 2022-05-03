FROM php:7.4-apache

RUN a2enmod rewrite

RUN docker-php-ext-install pdo pdo_mysql mysqli \
  && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

COPY ./var/www

WORKDIR /var/www

CMD ["apache-foreground"]
