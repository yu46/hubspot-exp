FROM php:7.4-fpm-alpine

ENV COMPOSER_ALLOW_SUPERUSER 1

RUN apk --no-cache update && \
    apk --no-cache upgrade && \
    apk --no-cache add \
    curl-dev \
    icu-dev \
    freetype-dev \
    libjpeg-turbo-dev \
    libpng-dev \
    libxml2-dev \
    zlib-dev \
    pcre-dev \
    g++ \
    make \
    autoconf \
    openssl \
    npm \
    bash \
    unzip \
    vim \
    git \
    oniguruma-dev \
    libzip-dev \
    rsync

RUN docker-php-ext-configure gd \
    --with-freetype=/usr/include/ \
    --with-jpeg=/usr/include/ \
  && docker-php-ext-install -j$(nproc) \
    curl \
    dom \
    mbstring \
    pdo \
    pdo_mysql \
    simplexml \
    intl \
    zip \
    opcache \
    gd \
  && pecl install xdebug \
  && docker-php-ext-enable xdebug \
  && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \
  && chmod +x /usr/local/bin/composer \
  && rm -rf /var/cache/apk/*

RUN curl -sSL https://github.com/mailhog/mhsendmail/releases/download/v0.2.0/mhsendmail_linux_amd64 -o mhsendmail \
    && chmod +x mhsendmail \
    && mv mhsendmail /usr/local/bin/mhsendmail

