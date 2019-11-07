FROM php:7.2-fpm

RUN apt-get update

RUN apt-get install -y \
        zlib1g-dev \
        libicu-dev \
        git-core \
        libxrender1 \
        libfontconfig1 \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libpng-dev

RUN docker-php-ext-configure gd --with-gd \
        --with-jpeg-dir=/usr/include/ \
        --with-png-dir=/usr/include/ \
        --with-freetype-dir=/usr/include/

ADD ./conf/uploads.ini /usr/local/etc/php/conf.d/uploads.ini
ADD ./conf/opcache.ini /usr/local/etc/php/conf.d/opcache.ini
ADD ./conf/xdebug.ini /usr/local/etc/php/conf.d/xdebug.ini
ADD conf/core.ini /usr/local/etc/php/conf.d/core.ini

RUN pecl install apcu

RUN pecl install xdebug

RUN docker-php-ext-install pdo pdo_mysql zip gd intl opcache

RUN docker-php-ext-enable apcu xdebug

ENV TZ Europe/Paris

RUN ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone

WORKDIR /var/www

RUN usermod -u 1000 www-data

USER www-data
