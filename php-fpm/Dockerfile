FROM phpdockerio/php:8.2-fpm
WORKDIR "/var/www"

RUN apt-get update \
    && apt-get -y --no-install-recommends install \
        php8.2-imagick \
        php8.2-xdebug \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /usr/share/doc/*
