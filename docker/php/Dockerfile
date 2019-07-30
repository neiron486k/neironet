FROM php:7.3-fpm
MAINTAINER Alexey Astafev "efsneiron@gmail.com"

RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
RUN php -r "if (hash_file('sha384', 'composer-setup.php') === '48e3236262b34d30969dca3c37281b3b4bbe3221bda826ac6a9a62d6444cdb0dcd0615698a5cbe587c3f0fe57a54d8f5') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
RUN php composer-setup.php
RUN php -r "unlink('composer-setup.php');"
RUN /bin/bash -c 'mv composer.phar /usr/local/bin/composer'

RUN  apt update \
  && apt install -y \
     libzip-dev \
     zip \
     libfreetype6-dev \
     libjpeg62-turbo-dev \
     libpng-dev \
  && docker-php-ext-install -j$(nproc) iconv \
  && docker-php-ext-install -j$(nproc) gd \
  && docker-php-ext-configure zip --with-libzip \
  && docker-php-ext-install zip \
  && docker-php-ext-install pdo_mysql \
  && pecl install redis-5.0.2 \
  && docker-php-ext-enable redis