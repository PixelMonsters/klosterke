FROM php:8.3-fpm-bookworm

# Install dependencies
RUN apt-get update && apt-get install --no-install-recommends --no-install-suggests -y \
    apt-transport-https \
    ca-certificates \
    openssh-client \
    curl \
    dos2unix \
    git \
    gnupg2 \
    dirmngr \
    g++ \
    jq \
    libedit-dev \
    libfcgi0ldbl \
    libfreetype6-dev \
    libicu-dev \
    libjpeg62-turbo-dev \
    libmcrypt-dev \
    libpq-dev \
    unzip \
    zip \
    libzip-dev \
    default-mysql-client \
    libwebp-dev \
    && rm -r /var/lib/apt/lists/*

# Install Redis extension
RUN pecl install redis && docker-php-ext-enable redis

# Install PHP extensions
RUN docker-php-ext-install \
    pdo_mysql \
    mysqli \
    intl \
    pcntl \
    zip

# Configure and install GD extension with WebP support
RUN docker-php-ext-configure gd --with-freetype --with-jpeg --with-webp \
    && docker-php-ext-install gd

# Install and configure Xdebug
RUN pecl install xdebug \
    && docker-php-ext-enable xdebug

RUN echo "xdebug.mode=debug,coverage" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.client_host=host.docker.internal" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.start_with_request=yes" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.discover_client_host=1" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.log_level=0" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini

# Install Composer
ENV PATH="/composer/vendor/bin:$PATH" \
    COMPOSER_ALLOW_SUPERUSER=1 \
    COMPOSER_VENDOR_DIR=/var/www/vendor \
    COMPOSER_HOME=/composer

RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" \
    && php composer-setup.php --no-ansi --install-dir=/usr/bin --filename=composer --version=2.8.3 \
    && php -r "unlink('composer-setup.php');"

# Create a new user and switch to it
RUN useradd -m -s /bin/bash appuser
USER appuser
