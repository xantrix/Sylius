FROM php:7.0.2-fpm

RUN \
  apt-get update && \
  apt-get install -y \
  curl wget nano unzip bzip2 locate git

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN apt-get update && apt-get install -y \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libmcrypt-dev \
        libpng12-dev \
        libicu-dev \
        libicu52  \
    && docker-php-ext-install iconv \
    && docker-php-ext-install -j$(nproc) mcrypt \
    && docker-php-ext-install zip \
    && docker-php-ext-install exif \
    && docker-php-ext-install mbstring \
    && docker-php-ext-install pdo_mysql \
    && docker-php-ext-install pdo \
    && docker-php-ext-install intl \
    && docker-php-ext-install opcache \
    && docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ \
    && docker-php-ext-install gd

#beta version support php7, change it with stable version in the future
RUN pecl install xdebug-beta \
    && docker-php-ext-enable xdebug

#memcached support php7
RUN apt-get install -y libmemcached-dev \
  && git clone -b php7 https://github.com/php-memcached-dev/php-memcached /usr/src/php/ext/memcached \
  && cd /usr/src/php/ext/memcached \
  && docker-php-ext-configure memcached \
  && docker-php-ext-install memcached

#Node
#RUN curl -sL https://deb.nodesource.com/setup_4.x | sudo -E bash -
#RUN sudo apt-get install -y nodejs

COPY php.ini    /usr/local/etc/php/conf.d/

EXPOSE 9000