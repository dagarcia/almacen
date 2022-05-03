FROM php:7.4-apache

RUN a2enmod rewrite

RUN apt-get update \
    && apt-get install -y apt-utils mc --no-install-recommends \
    && apt-get install -y git curl libicu-dev libxml2-dev g++ make autoconf libzip-dev wget libmemcached-dev zlib1g-dev --no-install-recommends \
    && apt-get clean \
    && docker-php-ext-install pdo pdo_mysql mysqli soap intl zip \
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
    # && rm -rf /var/lib/apt/lists/*  /tmp/* /var/tmp/*


# RUN docker-php-ext-install pdo pdo_mysql mysqli \
#   && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

COPY . /var/www

WORKDIR /var/www

CMD ["apache2-foreground"]
