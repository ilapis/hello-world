FROM php:8.0-fpm-alpine

RUN apk update; \
    apk upgrade;

RUN apk add bash nano git curl php-cli php-mbstring php-mysqli

RUN docker-php-ext-install mysqli pdo_mysql

RUN curl -sS https://getcomposer.org/installer -o composer-setup.php
RUN php composer-setup.php --install-dir=/usr/local/bin --filename=composer

# MEMCACHED

#ENV MEMCACHED_DEPS zlib-dev libmemcached-dev cyrus-sasl-dev
#RUN apk add --no-cache --update libmemcached-libs zlib
#RUN set -xe \
#    && apk add --no-cache --update --virtual .phpize-deps $PHPIZE_DEPS \
#    && apk add --no-cache --update --virtual .memcached-deps $MEMCACHED_DEPS \
#    && pecl install memcached \
#    && echo "extension=memcached.so" > /usr/local/etc/php/conf.d/20_memcached.ini \
#    && rm -rf /usr/share/php7 \
#    && rm -rf /tmp/* \
#    && apk del .memcached-deps .phpize-deps


# REDIS

#RUN set -xe \
#    && apk add --no-cache --update --virtual .phpize-deps $PHPIZE_DEPS \
#    && pecl install -o -f redis  \
#    && echo "extension=redis.so" > /usr/local/etc/php/conf.d/redis.ini \
#    && rm -rf /usr/share/php \
#    && rm -rf /tmp/* \
#    && apk del  .phpize-deps