FROM php:8.2-apache

# Install system dependencies
RUN apt-get update && apt-get install -y \
    unzip \
    git \
    curl \
    zip \
    libzip-dev \
    libxml2-dev \
    libicu-dev \
    libonig-dev \
    pkg-config \
    libssl-dev \
    build-essential

# Install PHP extensions
RUN docker-php-ext-install mysqli pdo pdo_mysql mbstring intl xml zip

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Install Composer globally
RUN curl -sS https://getcomposer.org/installer | php && \
    mv composer.phar /usr/local/bin/composer

# Copy Apache config
COPY .docker/apache.conf /etc/apache2/sites-available/000-default.conf

# Set working directory
WORKDIR /var/www/html
