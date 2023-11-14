FROM php:8.1.0-fpm

RUN apt-get update && apt-get install -y git
#In this place you can specify all the extensions you need.
RUN docker-php-ext-install pdo_mysql

RUN apt-get install -y \
        libzip-dev \
        zip \
        vim \
        libcurl4-openssl-dev  \
        pkg-config  \
        libssl-dev  \
        procps \
  && docker-php-ext-install zip

RUN  apt-get install git unzip wait-for-it wget libicu-dev -y && \
        docker-php-ext-install intl pdo_mysql && \
        echo 'extension=intl.so' > /usr/local/etc/php/conf.d/docker-php-ext-intl.ini

# Python
RUN apt-get install build-essential zlib1g-dev libncurses5-dev libgdbm-dev libnss3-dev libssl-dev libreadline-dev libffi-dev libsqlite3-dev wget libbz2-dev -y
RUN apt-get install python3 -y
RUN apt-get install python3-pip -y
RUN pip install Pillow

COPY --from=composer:2.0.9 /usr/bin/composer /usr/bin/composer

RUN composer self-update

RUN pecl install mongodb

ENV PHP_MEMORY_LIMIT=4G

WORKDIR /var/www
