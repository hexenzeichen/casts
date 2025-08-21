FROM php:8.4-apache
# Update
RUN apt-get update

# Install ZIP
RUN apt-get install -y libzip-dev zip libicu-dev git libpng-dev

# Install PHP extensions
RUN docker-php-ext-install zip pdo pdo_mysql mysqli intl gd pcntl

# Enable apache modules
RUN a2enmod rewrite
