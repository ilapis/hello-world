FROM php:8.0-fpm-alpine

RUN apk update; \
    apk upgrade;

RUN apk add bash nano git curl php-cli php-mbstring php-mysqli
RUN apk add openssh

RUN apk --no-cache add --virtual .build-deps $PHPIZE_DEPS \
  && apk --no-cache add --virtual .ext-deps libmcrypt-dev freetype-dev \
  libjpeg-turbo-dev libpng-dev libxml2-dev msmtp \
  && docker-php-source extract \
  && pecl install xdebug \
  && docker-php-ext-enable xdebug \
  && docker-php-source delete \
  && apk del .build-deps

RUN echo "xdebug.start_with_request=yes" >> /usr/local/etc/php/conf.d/xdebug.ini \
    && echo "xdebug.mode=coverage" >> /usr/local/etc/php/conf.d/xdebug.ini \
    && echo "xdebug.log=/var/www/html/xdebug/xdebug.log" >> /usr/local/etc/php/conf.d/xdebug.ini \
    && echo "xdebug.discover_client_host=1" >> /usr/local/etc/php/conf.d/xdebug.ini \
    && echo "xdebug.client_port=9000" >> /usr/local/etc/php/conf.d/xdebug.ini
	
RUN apk add --no-cache zip libzip-dev
#RUN docker-php-ext-configure zip --with-libzip
RUN docker-php-ext-install zip

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