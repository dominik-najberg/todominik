FROM phpdockerio/php74-fpm:latest

# Fix debconf warnings upon build
ARG DEBIAN_FRONTEND=noninteractive

# Arguments defined in docker-compose.yml
ARG user
ARG uid

# Timezone bull
ENV TZ=Europe/Warsaw
RUN ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    php7.4-mbstring \
    php7.4-bcmath \
    php7.4-xml \
    php7.4-xmlrpc \
    php7.4-zip \
    php7.4-sqlite3 \
    php7.4-mysql \
    php7.4-pgsql \
    php7.4-imap \
    php7.4-readline \
    php7.4-phpdbg \
    php7.4-curl \
    php7.4-dev \
    php7.4-amqp \
    php-pear \
    php-ssh2 \
    php-yaml \
    php-memcached \
    php-redis \
    php-apcu \
    php-xdebug \
    curl \
    unzip